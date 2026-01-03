<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 权限节点模型
 */
namespace app\admin\model;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
class AuthRule extends BaseModel
{
    public $error = '';
	use ModelTrait;
    // 表名
    protected $name = 'auth_rule';
    /**
     * 模块安装时进行Rule注册
     * @param array $data 菜单数据
     * @param string $moduleName 模块名称
     * @param int $pid 父菜单ID
     * @return bool
     */
    public  function installModule(array $data, $moduleName = '', $pid = 0)
    {
        if (empty($data) || !is_array($data)) {
            $this->error = '没有数据！';
            return false;
        }
        //默认安装时父级ID
        $default_pid = $this->where('name', 'admin/index/module')->value('id') ?: 0;
        //安装模块
        foreach ($data as $rs) {
            if ( empty($rs['name']) ) {
                $this->error = '菜单信息配置有误，规则不能为空！';
                //return false;
                continue;
            }
            //判断规则是否已经存在
            $id = $this->where('name', $rs['name'])->value('id');
            if (!$id) {
                $pid = $pid ?: ((is_null($rs['pid']) || !isset($rs['pid'])) ? (int)$default_pid : $rs['pid']);
                $newData = array(
                    'pid' => $pid,
                    'module' => $moduleName,
                    'type' => isset($rs['type']) ?: 1,
                    'name' => $rs['name'],
                    'title' => $rs['title'],
                    'show' => isset($rs['show']) ?: 0,
                    'condition' => isset($rs['condition']) ?: '',
                    'sort' => isset($rs['sort']) ?: 0,
                );
                if(isset($rs['icon']) && $rs['icon']){
                    $newData['icon'] = $rs['icon'];
                }
                if ($auth_id = $this->insertGetId($newData)) {
                    $id = $auth_id;
                } else {
                    $this->error = '菜单信息配置有误，' . $this->error;
                    return false;
                }
            }
            //是否有子菜单
            if (!empty($rs['child']) && $id) {
                if ($this->installModule($rs['child'], $moduleName, $id) !== true) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @param string $rule_ids
     * @return array|string[]
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function ruleList($rule_ids=''){
        $ids = [];
        if($rule_ids){
            $_rule_ids = str2arr($rule_ids,',');
            foreach ($_rule_ids as $id){
                $ids[] = intval($id);
            }
        }
        $_list = self::field('id,title as name,pid')->order(["sort" => "ASC", "id" => "ASC"])->select();
        $data  = ['checkedId'=>$ids];
        if(!$_list){
            return $data;
        }
        $data['list'] = $_list->toArray();
        return $data;
    }

    /**
     * 获取全部菜单数据
     * @param array $rule_ids
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function allData($rule_ids=''){
        if($rule_ids){
            $rule_ids = str2arr($rule_ids,',');
        }
        $_list = self::where('type','>',0)->where('pid','=',0)->order(["sort" => "ASC", "id" => "ASC"])->select();
        $data  = [];
        if(!$_list){
            return $data;
        }
        $_list = $_list->toArray();
        foreach ($_list as $k=>$r){
            $result = is_array($rule_ids) && in_array($r['id'],$rule_ids) ? true : false;
            $_data = [
                'id'=>$r['id'],
                'title'=>$r['title'],
                'checked'=>$result,
                'spread'=>$result
            ];
            $children = self::children($r['id'],$rule_ids);
            if($children){
                $_data['children'] = $children;
                $_data['disabled'] = true;
            }
            $data[] = $_data;
        }
        return $data;
    }

    /**
     * 获取子菜单
     * @param $pid
     * @param $rule_ids
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function children($pid,$rule_ids){
        $_list = self::where('type','>',0)->where('pid','=',$pid)->order(["sort" => "ASC", "id" => "ASC"])->select();
        if($_list){
            $_list = $_list->toArray();
            $data =[];
            foreach ($_list as $v){
                $result = is_array($rule_ids) && in_array($v['id'],$rule_ids) ? true : false;
                $_data = [
                    'id'=>$v['id'],
                    'title'=>$v['title'],
                    'checked'=>$result,
                    'spread'=>$result
                ];
                $children = self::children($v['id'],$rule_ids);
                if($children){
                    $_data['children'] = $children;
                    $_data['disabled'] = true;
                }
                $data[] = $_data;
            }
            return $data;
        }
        return [];
    }
}