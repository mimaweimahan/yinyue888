<?php
return [
    // 默认磁盘
    'default' => env('filesystem.driver', 'local'),
    // 磁盘列表
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . 'upload',
        ],
        'public' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'public',
            // 磁盘路径对应的外部URL路径
            'url'        => env('app.url', ''),
            'path'       => 'upload',
            // 可见性
            'visibility' => 'public',
        ],

//        // 腾讯云
//        'qcloud' => [
//            'type'       => 'qcloud',
//            'region'      => 'ap-chengdu', //bucket 所属区域 英文
//            'appId'      => '1329148294', // 域名中数字部分
//            'secretId'   => '',
//            'secretKey'  => '',
//            'bucket'          => 'mall-1329148294',
//            'timeout'         => 60,
//            'connect_timeout' => 60,
//            'cdn'             => '//imgs.baijiujishi.com',
//            'scheme'          => 'https',
//            'read_from_cdn'   => false,
//        ],
//        // 阿里云
//        'oss' => [
//            'type'     => 'aliyun',
//            'accessId' => '',
//            'accessSecret' => '',
//            'bucket'   => 'yjl-mall-2024',
//            'endpoint' => 'oss-cn-chengdu.aliyuncs.com',
//            'url'      => 'https://imgs.baijiujishi.com',
//            'path'     => '/'
//        ]
    ],
];
