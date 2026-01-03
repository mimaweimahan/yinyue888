<?php
return [
    [
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "pid" => null,
        //地址，[模块/]控制器/方法
        "name" => "swiper/index/init",
        //类型，0-只为菜单;1-认证规则+菜单;2认证+主菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "show" => 1,
        "icon"=>'#xe61e',
        //名称
        "title" => "轮播图管理",
        //子菜单列表
        "child" => [
            [
                "name" => "swiper/index/index",
                "show" => 1,
                "title" => "轮播图列表",
                "child"=>[
                    [
                        "name" => "swiper/index/delete",
                        "show" => 0,
                        "title" => "删除",
                    ],
                    [
                        "name" => "swiper/index/view",
                        "show" => 0,
                        "title" => "查看",
                    ],
                    [
                        "name" => "swiper/index/add",
                        "show" => 0,
                        "title" => "新增",
                    ],
                    [
                        "name" => "swiper/index/edit",
                        "show" => 0,
                        "title" => "编辑",
                    ],
                    [
                        "name" => "swiper/index/setfield",
                        "show" => 0,
                        "title" => "设置",
                    ],
                    [
                        "name" => "goods/admin.type/sort",
                        "show" => 0,
                        "title" => "排序",
                    ]
                ]
            ]
        ]
    ]
];
