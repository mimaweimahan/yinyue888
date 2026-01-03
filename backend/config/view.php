<?php
// +----------------------------------------------------------------------
// | 模板设置
// +----------------------------------------------------------------------

return [
    // 模板引擎类型使用Think
    'type'          => 'Think',
    // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写 3 保持操作方法
    'auto_rule'     => 2,
    'view_path'     =>'',
    // 模板目录名
    'view_dir_name' => 'view',
    // 模板后缀
    'view_suffix'   => 'php',
    'default_filter' => 'html_entities', //htmlentities 默认过滤方法 用于普通标签输出
    // 模板文件名分隔符
    'view_depr'     => DIRECTORY_SEPARATOR,
    // 模板引擎普通标签开始标记
    'tpl_begin'     => '{',
    // 模板引擎普通标签结束标记
    'tpl_end'       => '}',
    // 标签库标签开始标记
    'taglib_begin' => '{',
    // 标签库标签结束标记
    'taglib_end' => '}',
    'taglib_pre_load'=> 'app\common\taglib\Cms',
    // 视图输出字符串内容替换
    'tpl_replace_string'       => [
        '{__FONT_URL__}' =>  '//at.alicdn.com/t/font_2909323_iaui8bygaif.css',  //public 目录
        '{__PUBLIC__}' =>  '/',              //public 目录
        '{__STATIC__}' =>  '/statics/',       //全局静态目录
        '{__MODULE__}'   =>  '/statics/plug/',  //模块静态目录
    ]
];
