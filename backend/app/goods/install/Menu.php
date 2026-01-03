<?php
return [
    [
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "pid" => 0,
        //地址，[模块/]控制器/方法
        "name" => "goods/index/int",
        //类型，0-只为菜单;1-认证规则+菜单;2认证+主菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "show" => 0,
        "icon" =>'#xe677',
        "title" => "商品管理",//名称
        //子菜单列表
        "child" => [
            [
                "name" => "goods/index/index",
                "show" => 1,
                "title" => "商品列表",
                "child"=>[
                    [
                        "name" => "goods/index/add",
                        "show" => 0,
                        "title" => "新增",
                    ],
                    [
                        "name" => "goods/index/delete",
                        "show" => 0,
                        "title" => "删除",
                    ],
                    [
                        "name" => "goods/index/edit",
                        "show" => 0,
                        "title" => "编辑",
                    ],
                    [
                        "name" => "goods/index/setField",
                        "show" => 0,
                        "title" => "上下架",
                    ],
                    [
                        "name" => "goods/index/top",
                        "show" => 0,
                        "title" => "推荐",
                    ],
                    [
                        "name" => "goods/index/copy",
                        "show" => 0,
                        "title" => "复制",
                    ],
                    [
                        "name" => "goods/index/delAttribute",
                        "show" => 0,
                        "title" => "删除商品规格",
                    ],
                    [
                        "name" => "goods/index/delGroup",
                        "show" => 0,
                        "title" => "删除商品属性",
                    ],
                    [
                        "name" => "goods/index/config",
                        "show" => 0,
                        "title" => "批量设置",
                    ]

                ]
            ],
            [
                "name" => "goods/type/index",
                "show" => 1,
                "title" => "产品分类",
                "child"=>[
                    [
                        "name" => "goods/type/add",
                        "show" => 0,
                        "title" => "添加",
                    ],
                    [
                        "name" => "goods/type/edit",
                        "show" => 0,
                        "title" => "编辑",
                    ],
                    [
                        "name" => "goods/type/delete",
                        "show" => 0,
                        "title" => "删除",
                    ],
                    [
                        "name" => "goods/type/status",
                        "show" => 0,
                        "title" => "设置",
                    ],
                    [
                        "name" => "goods/type/sort",
                        "show" => 0,
                        "title" => "排序",
                    ],
                    [
                        "name" => "goods/type/typeCache",
                        "show" => 0,
                        "title" => "缓存",
                    ]
                ]
            ],
            [
                "name" => "goods/brand/index",
                "show" => 1,
                "title" => "产品品牌",
                "child"=>[
                    [
                        "name" => "goods/brand/add",
                        "show" => 0,
                        "title" => "添加",
                    ],
                    [
                        "name" => "goods/brand/edit",
                        "show" => 0,
                        "title" => "编辑",
                    ],
                    [
                        "name" => "goods/brand/delete",
                        "show" => 0,
                        "title" => "删除",
                    ],
                    [
                        "name" => "goods/brand/status",
                        "show" => 0,
                        "title" => "设置",
                    ],
                    [
                        "name" => "goods/brand/sort",
                        "show" => 0,
                        "title" => "排序",
                    ]
                ]
            ]
        ]
    ]
];