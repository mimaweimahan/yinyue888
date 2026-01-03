-- 条款表
DROP TABLE IF EXISTS `tp_clause`;
CREATE TABLE `tp_clause` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `content` text NOT NULL COMMENT '条款内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='条款表';

