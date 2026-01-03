<?php
/**
 * Explain: 产品分类
 */
namespace app\goods\model;
use app\common\traits\ModelTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Model;
use function cache;
class Type extends Model
{
    // 设置返回数据集的对象名
    protected $name ='goods_type';

    //插入数据时自动完成
    use ModelTrait;
    /**
     * 生成缓存
     */
    public static function typeCache() {
        cache("goods_type", NULL);
        $_type = self::order(['sort'=>'ASC', "id" => "ASC"])->select()->toArray();
        foreach ($_type as $r){
            //处理 child->是否存在子栏目, child_ids->所有子栏目ID
            $child_ids = self::where(["pid" => $r['id']])->field('id')->select()->toArray();
            if ($child_ids) {
                $_child_ids = [];
                $_child_ids[] = $r['id'];
                foreach ($child_ids as $n) {
                    $_child_ids[] = $n['id'];
                }
                $_child_ids = implode(',', $_child_ids);
                self::update(['child' => 1, "child_ids" => $_child_ids],['id' => $r['id']]);
            } else {
                self::update(['child' => 0, "child_ids" => $r['id']],['id' => $r['id']]);
            }
        }
        //重新获取数据
        $_data = self::order(["sort" => "ASC", "id" => "ASC"])->select()->toArray();
        $data = [];
        foreach ($_data as $r)
        {
            $data[$r['id']] = $r;
        }
        cache('goods_type', $data);
        return $data;
    }

    /**
     * 获取数据
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function allData($type_id=''){
        $map = ['pid' =>0];
        $_list = self::where($map)
            ->order([ "sort" => "ASC", "id" => "ASC"])
            ->select();
        $data  = [];
        if(!$_list){
            return $data;
        }
        $_list = $_list->toArray();
        foreach ($_list as $k=>$r){
            $result = ($type_id == $r['id']) ? true : false;
            $_data  = [
                'id'=>$r['id'],
                'title'=>$r['type_name'],
                'checked'=>$result,
                'spread'=>$result
            ];
            $children = self::children($r['id'],$type_id);
            if($children){
                $_data['children'] = $children;
            }
            $data[] = $_data;
        }
        return $data;
    }

    /**
     * 获取子菜单
     * @param $pid
     * @param $type_id
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function children($pid,$type_id){
        $_list = self::where('pid','=',$pid)->order(["mall" => "ASC","sort" => "ASC", "id" => "ASC"])->select();
        if($_list){
            $_list = $_list->toArray();
            $data =[];
            foreach ($_list as $v){
                $result = ($type_id == $v['id']) ? true : false;
                $_data = [
                    'id'=>$v['id'],
                    'title'=>$v['type_name'],
                    'checked'=>$result,
                    'spread'=>$result
                ];
                $children = self::children($v['id'],$type_id);
                if($children){
                    $_data['children'] = $children;
                }
                $data[] = $_data;
            }
            return $data;
        }
        return [];
    }
    /**
     * 生成ID对应的栏目缓存
     */
    public static function typeIdCache() {

        $data = self::order(['mall'=>'ASC','sort'=>'ASC', "id" => "ASC"])->cache(60)->select()->toArray();
        $type_list = [];
        foreach ($data as $r){
            $type_list[$r['id']] = $r;
        }
        return $type_list;
    }
}