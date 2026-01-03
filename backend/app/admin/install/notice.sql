-- 全局公告表
DROP TABLE IF EXISTS `tp_notice`;
CREATE TABLE `tp_notice` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '公告标题',
  `content` text NOT NULL COMMENT '公告内容',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '状态：0-隐藏，1-显示',
  `show_home` tinyint NOT NULL DEFAULT '0' COMMENT '首页展示：0-否，1-是',
  `sort` int NOT NULL DEFAULT '0' COMMENT '排序，数字越小越靠前',
  `create_time` int NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_show_home` (`show_home`),
  KEY `idx_sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='全局公告表';

