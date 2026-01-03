<?php
// +----------------------------------------------------------------------
// | |// | 模块配置
// +----------------------------------------------------------------------
return [
    //模块名称
    'module'=>'swiper',
    'module_name' => '轮播图模块',
    //*管理入口
    'admin_url'=>'swiper/index/index',
    //*全端访问入口
    'address' => 'swiper/index/index',
    //图标
    'icon' => '&#xe61e',
    //模块简介
    'introduce' => 'swiper模块',
    //模块作者
    'author' => 'WH',
    //版本号，请不要带除数字外的其他字符
    'version' => '1.0.0',
    //依赖模块
    'depend' =>[],
    //行为注册
    'tags' => [],
    //缓存，格式：缓存key=>['module','model_url','function')
    'cache' => []
];