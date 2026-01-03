<?php
return [
    [
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "pid" => null,
        //地址，[模块/]控制器/方法
        "name" => "sms/index/init",
        //类型，0-只为菜单;1-认证规则+菜单;2认证+主菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "show" => 1,
        "icon"=>'#xe65a',
        //名称
        "title" => "短信模块",
        //子菜单列表
        "child" => [
            [
                "name" => "sms/index/index",
                "show" => 1,
                "title" => "发送记录",
                "child"=>[
                    [
                        "name" => "sms/index/delete",
                        "show" => 0,
                        "title" => "删除记录",
                    ],
                    [
                        "name" => "sms/index/view",
                        "show" => 0,
                        "title" => "查看详细",
                    ],
                    [
                        "name" => "sms/index/send",
                        "show" => 0,
                        "title" => "发送短信",
                    ],
                    [
                        "name" => "sms/index/reply",
                        "show" => 0,
                        "title" => "重新发送",
                    ]
                ]
            ],
            [
                "name" => "sms/template/index",
                "show" => 1,
                "title" => "短信模板",
                "child"=>[
                    [
                        "name" => "sms/template/add",
                        "show" => 0,
                        "title" => "新增模板",
                    ],
                    [
                        "name" => "sms/template/edit",
                        "show" => 0,
                        "title" => "编辑模板",
                    ],
                    [
                        "name" => "sms/template/delete",
                        "show" => 0,
                        "title" => "删除记录",
                    ],
                    [
                        "name" => "sms/index/setField",
                        "show" => 0,
                        "title" => "状态设置",
                    ]
                ]
            ],
        ]
    ]
];
