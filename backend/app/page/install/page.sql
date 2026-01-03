SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `tp_diy_page`;
CREATE TABLE `tp_diy_page` (
     `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '单页ID',
     `title` varchar(255) NOT NULL COMMENT '当页名称',
     `thumb` varchar(300) NOT NULL COMMENT '缩略图',
     `label` varchar(32) NOT NULL COMMENT '调用标签',
     `padding` varchar(60) NOT NULL COMMENT '内容外边距',
     `quick` int(1) NOT NULL DEFAULT '0' COMMENT '开启快捷导航1是0否',
     `footer` int(1) NOT NULL DEFAULT '0' COMMENT '开启底部导航1是0否',
     `navbar` int(1) NOT NULL DEFAULT '0' COMMENT '开启顶部导航1是0否',
     `navbar_bg` varchar(32) NOT NULL DEFAULT '#FFF' COMMENT '顶部菜单背景色',
     `navbar_color` varchar(32) NOT NULL DEFAULT '#333' COMMENT '顶部菜字体颜色',
     `page_bg` varchar(32) NOT NULL DEFAULT '#FFF' COMMENT '页面背景颜色',
     `status` int(1) NOT NULL DEFAULT '0' COMMENT '开启状态1是0否',
     `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
     `content` text NOT NULL COMMENT '介绍',
     `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
     `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
     PRIMARY KEY (`id`),
     KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='自定义单页名称';

DROP TABLE IF EXISTS `tp_diy_nav`;
CREATE TABLE `tp_diy_nav` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '导航ID',
    `name` varchar(255) NOT NULL COMMENT '导航名称',
    `status` int(1) NOT NULL DEFAULT '0' COMMENT '开启状态1是0否',
    `image` varchar(255) NOT NULL COMMENT '导航图标',
    `url` varchar(300) NOT NULL COMMENT '导航地址',
    `color` varchar(60) DEFAULT NULL COMMENT '颜色',
    `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
    PRIMARY KEY (`id`),
    KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='方案分类';

BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;