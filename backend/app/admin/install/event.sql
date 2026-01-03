-- 事件表
DROP TABLE IF EXISTS `tp_event`;
CREATE TABLE `tp_event` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `content` text NOT NULL COMMENT '事件内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='事件表';

