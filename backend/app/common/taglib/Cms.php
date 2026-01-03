<?php
/**
 * Created by PhpStorm.
 * Explain: 自定义标签
 */
namespace app\common\taglib;
use think\template\TagLib;
class Cms extends TagLib
{
    /**
     * 定义标签列表
     */
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'get' => ['attr' => 'table,where,order,limit,id,page,page_url,pagefun,sql,field,key,mod,debug,empty', 'level' => 3],
        'swiper' => ['attr' => 'tab,limit,id,key', 'level' => 1],
        'page' => ['attr' => 'cat_id', 'level' => 1],
    ];
    /**
     * get标签
     * @param $tag [属性]
     * @param $content
     * @return string
     */
    public function tagGet($tag,$content)
    {
        $table = !empty($tag['table']) ? $tag['table'] : '';
        $order = !empty($tag['order']) ? $tag['order'] : '';
        $limit = !empty($tag['limit']) ? intval($tag['limit']) : 10;
        $id    = !empty($tag['id']) ? $tag['id'] : 'r';
        $where = !empty($tag['where']) ? $tag['where'] : '[]'; // 只能是数组
        $key   = !empty($tag['key']) ? $tag['key'] : 'i';
        $mod   = !empty($tag['mod']) ? $tag['mod'] : '2';
        $page  = !empty($tag['page']) ? $tag['page'] : false;

        $page_type = !empty($tag['pagefun']) ? $tag['pagefun'] : false;
        $page_url = !empty($tag['page_url']) ? $tag['page_url'] : false;
        $sql   = !empty($tag['sql']) ? $tag['sql'] : '';
        $field = !empty($tag['field']) ? $tag['field'] : '';
        $debug = !empty($tag['debug']) ? $tag['debug'] : false;
        $empty_tips = !empty($tag['empty']) ? trim($tag['empty']) : '';
        $this->comparison['noteq'] = '<>';
        $this->comparison['sqleq'] = '=';
        $where = $this->parseCondition($where);
        $sql   = $this->parseCondition($sql);
        $parse_str ='';
        //定义一个手机分页模板
        if ($sql) {
            if ($page) {
                $parse_str .= '$count = count(\think\facade\Db::query("' . $sql . '"));';
                if($page_url){
                    //
                    $parse_str .= '$p = new \think\Page( $count, ' . $limit . ',"","page",'.$page_url.' );';  //分页类引用
                }else{
                    $parse_str .= '$p = new \think\Page( $count, ' . $limit . ' );';  //分页类引用
                }

                //分页模板函数
                if($page_type &&$page_type == 'phone'){
                    $parse_str .= '$p->config = $page_type;';
                }

                $parse_str .= '$sql.="' . $sql . '";';
                $parse_str .= '$sql.=" limit ($p->firstRow, $p->listRows)";';
                $parse_str .= '$ret = \think\facade\Db::query($sql);';
                $parse_str .= '$pages = $p->show();';
            } else {
                $sql .= $limit ? (' limit ' . $limit) : '';
                $parse_str .= '$ret = $m->query("' . $sql . '");';
            }
        }

        if($table){
            $parse_str .= '<?php $m = \think\facade\Db::name("'.$table.'");';
            if ($page) {
                $parse_str .= '$count= $m->where(' . $where . ')->count();';
                if($page_url){
                    $parse_str .= '$p = new \think\Page( $count, ' . $limit . ',"","page",'.$page_url.' );';  //分页类引用
                }else{
                    $parse_str .= '$p = new \think\Page( $count, ' . $limit . ' );';  //分页类引用
                }
                if($page_type&&$page_type == 'phone'){
                    $parse_str .= '$p->config = $page_type;';
                }
                $parse_str .= '$ret  = $m->field("' . $field . '")->where(' . $where . ')->limit($p->firstRow,$p->listRows)->order("' . $order . '")->select();';
                $parse_str .= '$pages=$p->show();';
            } else {
                $parse_str .= '$ret = $m->field("' . $field . '")->where(' . $where . ')->order("' . $order . '")->limit("' . $limit . '")->select();';
            }
        }

        if ($debug != false) {
            $parse_str .= 'dump($ret); dump($m->getLastSql());';
        }
        if ($empty_tips){
            $parse_str .= 'if (count($ret)==0){ echo "<div class=\'empty-tips\'>'.$empty_tips.'</div>";}';
        }
        $parse_str .= 'if ($ret): $' . $key . '=0;';
        $parse_str .= 'foreach($ret as $key=>$' . $id . '):';
        $parse_str .= '++$' . $key . ';$mod = ($' . $key . ' % ' . $mod . ' );?>';
        $parse_str .= $content;
        $parse_str .= '<?php endforeach; endif;?>';
        return $parse_str;
    }

    /**
     * get标签
     * @param $tag [属性]
     * @param $content
     * @return string
     */
    public function tagSwiper($tag,$content)
    {
        $where = !empty($tag['where']) ? $tag['where'] : '[]'; // 只能是数组
        $tab   = !empty($tag['tab']) ? $tag['tab'] : '';
        $id    = !empty($tag['id']) ? $tag['id'] : 'r';
        $key   = !empty($tag['key']) ? $tag['key'] : 'i';
        $this->comparison['noteq'] = '<>';
        $this->comparison['sqleq'] = '=';
        $where = $this->parseCondition($where);
        $parse_str ='';
        $parse_str .= '<?php $ret = \app\swiper\model\Swiper::where('.$where.')->where(["tab"=>"'.$tab.'"])->find();';
        $parse_str .= 'if (isset($ret["swiper"])&&count($ret["swiper"])>0): $' . $key . '=0;';
        $parse_str .= 'foreach($ret["swiper"] as $key=>$' . $id . '):';
        $parse_str .= '';
        $parse_str .= '++$' . $key . ';?>';
        $parse_str .= $content;
        $parse_str .= '<?php endforeach; endif;?>';
        return $parse_str;
    }

    /**
     * page标签
     * @param $tag [属性]
     * @return string
     */
    public function tagPage($tag,$content)
    {
        $cat_id = !empty($tag['cat_id']) ? $tag['cat_id'] : 0;
        $cat_id = !empty($tag['cat_id']) ? $tag['cat_id'] : 0;
        if($cat_id == 0){
            return '';
        }
        $parse_str  = '<?php $r = \app\article\model\Article::getToArray(["is_page"=>1,"cat_id"=>'.$cat_id.']);';
        $parse_str .= 'if (isset($r["id"])): ?>';
        $parse_str .= $content;
        $parse_str .= '<?php endif; ?>';
        return $parse_str;
    }
}