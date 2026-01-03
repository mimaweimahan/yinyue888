<?php
return [
    [
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "pid" => 0,
        //地址，[模块/]控制器/方法
        "name" => "agent/index/int",
        //类型，0-只为菜单;1-认证规则+菜单;2认证+主菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "show" => 0,
        "icon" =>'#xe602',
        "title" => "代理管理",//名称
        //子菜单列表
        "child" => [
            [
                "name" => "agent/index/index",
                "show" => 1,
                "title" => "代理列表",
                "child"=>[
                    [
                        "name" => "agent/index/add",
                        "show" => 0,
                        "title" => "新增",
                    ],
                    [
                        "name" => "agent/index/delete",
                        "show" => 0,
                        "title" => "删除",
                    ],
                    [
                        "name" => "agent/index/edit",
                        "show" => 0,
                        "title" => "编辑",
                    ],
                    [
                        "name" => "agent/index/setField",
                        "show" => 0,
                        "title" => "字段设置",
                    ],
                    [
                        "name" => "agent/index/config",
                        "show" => 0,
                        "title" => "设置",
                    ]
                ]
            ]
        ]
    ]
];