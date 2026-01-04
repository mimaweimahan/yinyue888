<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace think;
use think\facade\Request;
class Page{
    public $firstRow; // 起始行数
    public $listRows; // 列表每页显示行数
    public $parameter; // 分页跳转时要带的参数
    public $totalRows; // 总行数
    public $totalPages; // 分页总页面数
    public $rollPage   = 8;// 分页栏每页显示的页数
	public $lastSuffix = true; // 最后一页是否显示总页数

    public  $p       = 'page'; //分页参数名
    private $url     = ''; //当前链接URL
    public  $p_url   = '';
    private $nowPage = 1;

	// 分页显示定制
    public $config  = array(
        'header' => '共 %TOTAL_ROW% 条记录',
        'prev'   => '&laquo;',
        'next'   => '&raquo;',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% <li><span>%HEADER%%NOW_PAGE%/%TOTAL_PAGE%</span></li>',
        //'theme'  => '<li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE%</li>'
    );

    /**
     * 架构函数
     * @param array $totalRows  总的记录数
     * @param int $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     * @param string $varPage  分页变量
     */
    public function __construct($totalRows, $listRows=20, $parameter = array(),$varPage='page',$p_url='') {
        /* 基础设置 */
        $param = Request::param();
        $this->p          = $varPage ;
        $this->totalRows  = $totalRows; //设置总记录数
        $this->listRows   = $listRows;  //设置每页显示行数
        $this->parameter  = empty($parameter) ? $param : $parameter;
        $this->nowPage    = empty($param[$this->p]) ? 1 : intval($param[$this->p]);
        $this->nowPage    = $this->nowPage>0 ? $this->nowPage : 1;
        $this->firstRow   = $this->listRows * ($this->nowPage - 1);
        $this->totalPages = ceil(intval($this->totalRows) / intval($this->listRows)); //总页数
        $this->p_url = $p_url; //当前路由
    }

    /**
     * 定制分页链接设置
     * @param string $name  设置名称
     * @param string $value 设置值
     */
    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 生成链接URL
     * @param  integer $page 页码
     * @return string
     */
    private function url($page){
        if($this->p_url){
            return str_replace('[PAGE]', $page, $this->url);
        }
        return str_replace(urlencode('[PAGE]'), $page, $this->url);
    }

    /**
     * 组装分页链接
     * @return string
     */
    public function show() {
        if(0 == $this->totalRows) return '';
        /* 生成URL */
        $this->parameter[$this->p] = '[PAGE]';
        if($this->p_url){
            $this->url = $this->p_url;
        }else{
            $this->url = url(app('request')->action(), $this->parameter);
        }

        /* 计算分页信息 */
        $this->totalPages = ceil(intval($this->totalRows) / intval($this->listRows)); //总页数
        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }

        /* 计算分页临时变量 */
        $now_cool_page      = $this->rollPage/2;
		$now_cool_page_ceil = ceil($now_cool_page);

		$this->lastSuffix = $this->totalPages;
        $this->config['last']= $this->totalPages;

        //上一页
        $up_row  = $this->nowPage - 1;
        if($up_row > 0){
            $up_page =  '<li><a href="' . $this->url($up_row) . '">' . $this->config['prev'] . '</a></li>';
        }else if(($this->nowPage + 1 <= $this->totalPages)){
            $up_page =  '<li class="am-disabled"><span>'.$this->config['prev'].'</span></li>';
        }else{
            $up_page = '';
        }

        //下一页
        $down_row  = $this->nowPage + 1;
        if(($down_row <= $this->totalPages)){
            $down_page =  '<li><a href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a></li>';
        }else if($up_row>0){
            $down_page = '<li class="am-active"><span>'.$this->config['next'].'</span></li>';
        }else{
            $down_page = '';
        }
        //第一页
        $the_first = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1){
            $the_first = '<li><a href="' . $this->url(1) . '">' . $this->config['first'] . '</a></li>';
        }

        //最后一页
        $the_end = '';
        if($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages){
            $the_end = '<li><a href="' . $this->url($this->totalPages) . '">' . $this->config['last'] . '</a></li>';
        }

        //数字连接
        $link_page = "";
        for($i = 1; $i <= $this->rollPage; $i++){
			if(($this->nowPage - $now_cool_page) <= 0 ){
				$page = $i;
			}elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
				$page = $this->totalPages - $this->rollPage + $i;
			}else{
				$page = $this->nowPage - $now_cool_page_ceil + $i;
			}
            if($page > 0 && $page != $this->nowPage){

                if($page <= $this->totalPages){
                    $link_page .= '<li><a href="' . $this->url($page) . '">' . $page . '</a></li>';
                }else{
                    break;
                }
            }else{
                if($page > 0 && $this->totalPages != 1){
                    $link_page .= '<li class="am-active"><span>' . $page . '</span></li>';
                }
            }
        }

        //替换分页内容
        $page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
            array('', $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
            $this->config['theme']);
        return "{$page_str}";
    }
}
