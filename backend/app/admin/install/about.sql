-- 关于我们表
DROP TABLE IF EXISTS `tp_about`;
CREATE TABLE `tp_about` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `content` text NOT NULL COMMENT '关于我们内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='关于我们表';

