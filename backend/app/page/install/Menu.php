<?php
return [
    [
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "pid" => 0,
        //地址，[模块/]控制器/方法
        "name" => "page/index/index",
        //类型，0-只为菜单;1-认证规则+菜单;2认证+主菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "show" => 1,
        "icon"=>'#xe6eb',
        //名称
        "title" => "自定义单页",
        //子菜单列表
        "child" => [
            [
                [
                    "name" => "page/index/add",
                    "show" => 0,
                    "title" => "添加",
                ],
                [
                    "name" => "page/index/delete",
                    "show" => 0,
                    "title" => "删除",
                ],
                [
                    "name" => "page/index/edit",
                    "show" => 0,
                    "title" => "编辑",
                ],
                [
                    "name" => "page/index/setfield",
                    "show" => 0,
                    "title" => "设置",
                ],
                [
                    "name" => "page/index/sort",
                    "show" => 0,
                    "title" => "排序",
                ]
            ]
        ]
    ],
    [
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "pid" => 0,
        //地址，[模块/]控制器/方法
        "name" => "page/nav/index",
        //类型，0-只为菜单;1-认证规则+菜单;2认证+主菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "show" => 1,
        "icon"=>'#xe603',
        //名称
        "title" => "图标导航",
        //子菜单列表
        "child" => [
            [
                [
                    "name" => "page/nav/add",
                    "show" => 0,
                    "title" => "添加",
                ],
                [
                    "name" => "page/nav/delete",
                    "show" => 0,
                    "title" => "删除",
                ],
                [
                    "name" => "page/nav/edit",
                    "show" => 0,
                    "title" => "编辑",
                ],
                [
                    "name" => "page/nav/setfield",
                    "show" => 0,
                    "title" => "设置",
                ],
                [
                    "name" => "page/nav/sort",
                    "show" => 0,
                    "title" => "排序",
                ]
            ]
        ]
    ]
];
