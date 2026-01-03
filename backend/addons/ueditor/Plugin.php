<?php
/**
 * ueditor 编辑器
 */
namespace addons\ueditor;
use app\admin\model\AuthRule;
use think\Addons;
class Plugin extends Addons
{
    // 该插件的基础信息
    public $info = [
        'name' => 'ueditor',// 插件标识
        'title' => '编辑器',// 插件名称
        'description' => '所见所得文本编辑器',// 插件简介
        'status' => 1,    // 状态
        'author' => 'TT',
        'version' => '0.1',
        'install' => 0,// 是否已安装[1 已安装，0 未安装]
    ];

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        $menu = [
            [
                //父菜单ID，NULL或者不写系统默认，0为顶级菜单
                "pid"     => null,
                'name'    => 'addons/pay/index/index',
                'title'   => '支付插件',
                'icon'    => '&#xe66f;',
                //类型，0-只为菜单;1-认证规则+菜单;2认证+主菜单
                "type" => 1,
                'child' => [
                    ['name' => 'addons/pay/index/index',"show" => 0, 'title' => '查看'],
                    ['name' => 'addons/pay/index/add',"show" => 0, 'title' => '添加'],
                    ['name' => 'addons/pay/index/detail',"show" => 0, 'title' => '详情'],
                ]
            ]
        ];
        //AuthRule::create($menu);
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        AuthRule::destroy(['module'=>'ueditor']);
        return true;
    }

    /**
     * 实现的ueditorHook钩子方法 {:hook('testhook', ['id'=>1])}
     * @throws \think\Exception
     */
    public function ueditorHook($param)
    {
        $name  = isset($param['name']) ? $param['name'] : 'content';
        $val   = isset($param['val']) ? $param['val'] : '';
        $width = isset($param['width']) ? $param['width'] : 100;
        $height= isset($param['height']) ? $param['height'] : 300;
        $get_edit_js = '';
        //加载编辑器所需JS，多编辑器字段防止重复加载
        if (!defined('IS_UE')) {
            $get_edit_js .= '<script type="text/javascript" src="/statics/extend/ueditor/ueditor.config.js?v=1.4"></script> <script type="text/javascript" src="/statics/extend/ueditor/ueditor.all.min.js"></script>';
            define('IS_UE', 1);
        }
        $toolbar = "[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
            'print', 'preview', 'searchreplace', 'help', 'drafts'
        ]";
        $str  = $get_edit_js."\r\n";
        $this->assign('ueditor',$str);
        $this->assign('toolbar',$toolbar);
        $this->assign('name',$name);
        $this->assign('val',$val);
        $this->assign('width',$width);
        $this->assign('height',$height);
        return $this->fetch('index/ueditor');
    }
}