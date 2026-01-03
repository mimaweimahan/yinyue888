-- APP下载链接表
DROP TABLE IF EXISTS `tp_app_download`;
CREATE TABLE `tp_app_download` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `url` varchar(500) NOT NULL DEFAULT '' COMMENT '下载链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='APP下载链接表';

