SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_swiper
-- ----------------------------
DROP TABLE IF EXISTS `tp_swiper`;
CREATE TABLE `tp_swiper` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) NOT NULL COMMENT '名称',
  `tab` varchar(60) NOT NULL COMMENT '位置及调用标识',
  `note` varchar(500) NOT NULL COMMENT '说明',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示[1是,0否]',
  `swiper` text NOT NULL COMMENT 'swiper图片',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='swiper管理';

SET FOREIGN_KEY_CHECKS = 1;