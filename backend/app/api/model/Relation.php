<?php
/**
 * Explain: 用户推荐关系
 */
namespace app\api\model;
use app\common\model\User;
use app\common\model\user\UserWallet;
use app\common\model\user\UserGrade;
use app\common\traits\ModelTrait;
use app\order\model\Order;
use core\services\MiniProgramService;
use think\facade\Db;
use think\Model;
use core\utils\Tools;
use think\model\relation\HasOne;

class Relation extends Model
{
    protected $name ='relation';
    protected $append = ['referee_name'];

    //插入数据时自动完成
    use ModelTrait;
    // 处理add_time数据
    public function setRefereeTimeAttr()
    {
        return time();
    }
    public function getRefereeTimeAttr($val){
        if($val){
            return date('Y-m-d H:i:s',$val);
        }
        return '';
    }

    public function getRefereeNameAttr($val,$data){
        if(isset($data['referee_id']) && $data['referee_id']>0){
            return User::where('id',$data['referee_id'])->value('nickname');
        }
        return '';
    }

    /**
     * 推荐关系
     * @return Db
     */
    public static function ListDb(){
        return Db::view('relation','*')
            ->view('user','mobile,account,grade_id,nickname','user.id = relation.uid')
            ->view('user_data','agent_area','user.id = user_data.uid')
            ->view('user_grade','grade_name','user_grade.id = user.grade_id','LEFT');
    }

    /**
     * 推荐人
     * @return HasOne
     */
    public function referee()
    {
        return $this->hasOne(User::class,'id', 'referee_id')->bind(['mobile','grade_id']);
    }

    /**
     * 获取用户的所有上级推荐人
     * @param int $uid 目标用户ID
     * @return array 包含所有上级推荐人的数组，按层级从近到远排序
     */
    public static function getAllReferrers(int $uid): array {
        $referrers = [];
        $currentId = $uid;
        while (true) {
           // $row = self::with(['referee'])->where('uid',$currentId)->field('uid,referee_id')->select()->toArray();
            $row = self::getToArray(['uid'=>$currentId],'uid,referee_id',['referee']);
            if (!$row || !isset($row['referee_id'])) {
                break;
            }
            $referrerId = (int)$row['referee_id'];
            $referrers[] = $row;
            $currentId = $referrerId;
        }
        return $referrers;
    }

    /**
     * 绑定关系
     * @param int $member_id 会员ID
     * @param int $referee_id 推荐人ID
     * @return bool|int|string
     */
    public static function binding($member_id = 0, $referee_id=0){
        if(!$referee_id){
            return 0;
        }
        if($member_id == $referee_id){
            return 0;
        }
        // 判断用户是否已经绑定，如果已经绑定就反推推荐人的ID
        $repeat = self::where('uid',$member_id)->value('referee_id');
        if($repeat){
            return $repeat;
        }
        $user = User::getToArray(['id'=>$member_id]);
        // 推荐人名称
        $referee_name = User::where('id',$referee_id)->value('nickname');
        if(!$referee_name){
            return 0;
        }
        # 获取团队成员ID
        $team = self::where(['uid'=>$referee_id])->value('team_id');
        if($team){
            $team = $team.','.$referee_id;
        }else{
            $team = $referee_id.','.$member_id;
        }
        $id = self::insertGetId([
            'uid'=>$member_id,
            'referee_id'=>$referee_id,
            'team_id'=>$team,
            'referee_time'=>time()
        ]);
        if($id > 0){
            #//创建团层级关系
            $team_id_arr = str2arr($team,',');
            $team_id_arr = array_reverse($team_id_arr,true);
            $level = 1;
            foreach ($team_id_arr as $rf_id){
                if($rf_id != $member_id ){
                    $being = RelationTeam::where(['uid'=>$member_id,'parent_id'=>$rf_id])->value('id');
                    if(!$being){
                        RelationTeam::create(['uid'=>$member_id,'parent_id'=>$rf_id,'level'=>$level]);
                    }
                    $level++;
                }
            }
            return $referee_id;
        }
        return 0;
    }

    /**
     * 推荐奖励
     * @param array $order
     * @return bool
     */
    public static function reward($order=[]){
        //订单模型
        if($order['module'] == 'free'){
            return false;
        }
        //推荐返佣
        if(!isset($order['referee_id'])){
            return false;
        }
        //获取消费人的等级
        $user_grade_id = User::where(['id'=>$order['uid']])->value('grade_id');
        $user_grade = UserGrade::getToArray(['id'=>$user_grade_id]);

        //推荐人的等级信息
        $referee_grade_id = User::where(['id'=>$order['uid']])->value('grade_id');
        $referee_grade = UserGrade::getToArray(['id'=>$user_grade_id]);

        //如果被推荐人和推荐人平级或被推荐人等级高于推荐人
        if($referee_grade_id == $user_grade_id || $user_grade_id>$referee_grade_id){
            return false;
        }
        //会员折扣
        $discount = floatval($referee_grade['discount']) - floatval($user_grade['discount']);
        if($discount > 0){
            //获取订单金额 返佣 = 订单支付金额*会员折扣
            $amount = int2(floatval($order['amount'])*$discount);
            if($amount){
                Order::update( ['settlement'=>1,'update_time'=>time()],['id'=>$order['id']] );
                UserWallet::updateAc($order['referee_id'],['amount'=>$amount],'推荐奖励',5,$order);
            }
        }
        return false;
    }

    /**
     * 会员推广码
     */
    public static function poster($uid=0, $type='h5',$is_new = 1){
        if($uid == 0){
            return self::error('缺少参数！');
        }
        $_poster = parse_url(getConfig('poster'));
        $poster_bg_img = $_poster['path'];
        $poster_bg = app()->getRootPath() . 'public/'.$poster_bg_img;//海报背景
        $path_url  = '/upload/qrcode/';
        $path = app()->getRootPath() . 'public'.$path_url;

        if (!file_exists($path)) {
            mk_dir($path, 0777);//检查是否有该文件夹，如果没有就创建，并给予最高权限
        }
        $filename = $type.'_poster_'.$uid.'.jpg';
        if($is_new == 0 && file_exists($path.$filename)){
            return getConfig('config_app_url').$path_url.$filename;
        }
        $nickname = User::where('id',$uid)->value('nickname');
        if($type == 'mp'){
            $qr_code = '';
            $pages   = '/pages/login/index?referee_id='.$uid;
            $result  = MiniProgramService::createQRCode($pages,300);
            if($result['code'] == 1){
                $qr_code = $path.'mp_code_w_'.$uid.'.jpg';
                file_put_contents($qr_code, $result['data']);
            }
        }else{
            $code_url = urlencode( getConfig('config_app_url').'/pages/login/index?referee_id='.$uid );
            $_qr_code = getConfig('config_app_url').url('tool/qrcode/png',['data'=>$code_url]);
            $qr_code  = Tools::download($_qr_code, $path, 'h5_code_w_'.$uid.'.jpg');
            $qr_code = $path.$qr_code;
        }
        if(!$qr_code ){
            return '';
        }
        $config = array(
            'image'=>array(
                // 二维码
                array(
                    'url'=>$qr_code,//图片资源路径
                    'stream' => 0,
                    'left' => 114,
                    'top' => 790,
                    'right' => 0,
                    'bottom' => 0,
                    'width' => 120,
                    'height' => 120,
                    'opacity' => 100
                )
            ),
            'text'=>array(
                array(
                    'text' => $nickname,
                    'left' => 250,
                    'top' => 840,
                    'fontPath'=>app()->getRootPath().'extend/simheittf.ttf',//字体文件
                    'fontSize' => 16,//字号
                    'fontColor' => '40,40,40',//字体颜色
                    'angle' => 0,
                ),
                array(
                    'text' => '邀请您加入'.getConfig('site_name'),
                    'left' => 250,
                    'top' => 880,
                    'fontPath'=>app()->getRootPath().'extend/simheittf.ttf',//字体文件
                    'fontSize' => 16,//字号
                    'fontColor' => '40,40,40',//字体颜色
                    'angle' => 0,
                )
            ),
            'background'=>$poster_bg
        );
        $file = Tools::createPoster($config,$filename);
        if($file){
            return getConfig('config_app_url').$path_url.$filename;
        }
        return '';
    }
}