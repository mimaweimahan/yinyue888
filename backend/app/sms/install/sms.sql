SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_sms_log
-- ----------------------------
DROP TABLE IF EXISTS `tp_sms_log`;
CREATE TABLE `tp_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `result` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`),
  KEY `status` (`status`),
  KEY `create_time` (`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='短信记录';

-- ----------------------------
-- Table structure for tp_sms_template
-- ----------------------------
DROP TABLE IF EXISTS `tp_sms_template`;
CREATE TABLE `tp_sms_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态[1是,0否]',
  `template_id` int(11) NOT NULL DEFAULT '0' COMMENT '模板编号',
  `template_name` varchar(250) NOT NULL COMMENT '模板名称',
  `content` text NOT NULL COMMENT '模板内容',
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `template_name` (`template_name`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='短信模板';

SET FOREIGN_KEY_CHECKS = 1;