<?php
declare (strict_types = 1);
/**
 * Explain: 菜单处理
 */
namespace app\common\service;
use app\admin\model\AuthRule;
use app\admin\model\Admin;
class Rule
{
    public static function getRule(){
        $app = app('http')->getName();
        $controller = app('request')->controller();
        $action = app('request')->action();
        return strtolower($app.'/'.$controller.'/'.$action);
    }

    public static function info($rule=''){
        $now_rule = self::getRule();
        if($rule==''){
            $rule = $now_rule;
        }
        $data = ['title'=>'','note'=>'','url'=>''];
        if(!$rule){
            return $data;
        }
        $result = AuthRule::get(['name'=>$rule]);
        if($result){
            $result = $result->toArray();
            return [ 'title'=>$result['title'], 'note'=>$result['note'] , 'url'=>$result['name']];
        }
        return $data;
    }

    /**
     * 获取子目录
     */
    public static function subNav($rule=''){
        $now_rule = self::getRule();
        if($rule==''){
            $rule = $now_rule;
        }
        $where = [];
        $where['show'] = 1;
        $admin = Admin::loginAdmin();
        if(isset($admin['group_id']) && $admin['group_id']){
            $group_id    = $admin['group_id'];
            $admin_rules = $admin['rules'];
            if($group_id>1){
                $where['id'] = ['IN',$admin_rules];
            }
        }
        if( $nav = AuthRule::where(['name'=>$rule])->find()){
            $nav = $nav->toArray();
            $where['pid'] = $nav['id'];
            $sub_list = AuthRule::getList($where,0,["sort" => "ASC","id" => "ASC"]);
            if(is_array($sub_list) && $sub_list && $nav){
                $_nav[]   = $nav;
                $sub_list = array_merge($_nav,$sub_list);
            }
            $tpl = '';
            foreach ($sub_list as $k=>$v){
                if($v['name'] == $now_rule){
                    $tpl.='<li class="layui-this"> <a href="'.url($v['name']).'" target="main">'.$v['title'].'</a></li>';
                }else{
                    $tpl.='<li> <a href="'.url($v['name']).'" target="main">'.$v['title'].'</a></li>';
                }
            }
            return $tpl;
        }
        return false;
    }

    /**
     * 获取菜单 json 数据
     * @param int $_pid
     * @return false|string
     */
    public static function jsonMenu($_pid = 0){
        $json_data = self::getTree($_pid);
        return json_encode($json_data,256);
    }

    /**
     * 根据权限获取数据
     * @param int $pid
     * @return mixed
     */
    public static function menuAuth($pid = 0){
        $map = [
            ['show','=',1],
            ['pid','=',$pid]
        ];
        $admin = Admin::loginAdmin();
        if(isset($admin['admin_id']) && $admin['admin_id']>1 && isset($admin['rules']) && $admin['group_id']>1 && $admin['rules']){
            $map[] = ['id','IN',$admin['rules']];
        }
        return AuthRule::getList($map,0,"sort ASC id ASC");
    }

    /**
     * 取得树形结构的菜单
     * @param int $menu_id
     * @param int $parent
     * @param int $level
     * @return mixed
     */
    public static function getTree($menu_id = 0, $parent = 0, $level = 1) {
        $data = self::menuAuth($menu_id);
        $level++;
        $ret = array();
        if (is_array($data)) {
            foreach ($data as $k=>$r) {
                $id = $r['id'];
                //附带参数
                $fu = "";
                if ($r['condition']) {
                    $fu = $r['condition'];
                }
                $array = array(
                    "id" => $id ,
                    "icon" => $r['icon'],
                    "name" => $r['title'],
                    "parent" => $parent,
                    "url" => url($r['name']).$fu,
                    "rule"=>$r['name']
                );
                $ret[$k] = $array;
                $child = self::getTree($r['id'], $id, $level);
                //由于后台管理界面只支持三层，超出的不层级的不显示
                if ($child && $level <= 2) {
                    $ret[$k]['items'] = $child;
                }
            }
        }
        return $ret;
    }
}
