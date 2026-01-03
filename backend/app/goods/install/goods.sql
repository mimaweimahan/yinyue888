SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `tp_goods`;
CREATE TABLE `tp_goods` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
    `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '代理ID',
    `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
    `sub_title` varchar(255) NOT NULL COMMENT '副标题',
    `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
    `thumb` varchar(500) DEFAULT NULL COMMENT '图片',
    `share_pic` varchar(255) DEFAULT NULL COMMENT '分享图片',
    `type_id` smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT '所属类别id',
    `category_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1虚拟商品，0实物',
    `brand_id` smallint(8) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
    `tags` varchar(500) DEFAULT NULL COMMENT '标签(多个标签以空格隔开)',
    `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态(0.等待上架，1.上架出出售，2.等待审核)',
    `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是推荐商品(0.否，1.是)',
    `content` text COMMENT '商品详情',
    `sales_volume` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
    `update_time` int(11) NOT NULL DEFAULT '0',
    `del_time` int(11) NOT NULL DEFAULT '0' COMMENT '删除时间',
    `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
    PRIMARY KEY (`id`) USING BTREE,
    UNIQUE KEY `add_time` (`add_time`) USING BTREE,
    KEY `type_id` (`type_id`) USING BTREE,
    KEY `is_top` (`is_top`) USING BTREE,
    KEY `status` (`status`) USING BTREE,
    KEY `category_id` (`category_id`) USING BTREE,
    KEY `update_time` (`update_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品详情表';

-- ----------------------------
-- Table structure for tp_goods_attribute
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_attribute`;
CREATE TABLE `tp_goods_attribute` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `shop_id` int(11) NOT NULL DEFAULT '0',
    `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
    `attribute_type_id` int(11) NOT NULL DEFAULT '0' COMMENT '类型id',
    `attribute_name` varchar(60) NOT NULL DEFAULT '' COMMENT '名称',
    `goods_number` varchar(250) NOT NULL DEFAULT '' COMMENT '编号',
    `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
    `attribute_pic` varchar(255) DEFAULT NULL COMMENT '图片',
    `cost_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成本价',
    `attribute_price` decimal(10,2) NOT NULL COMMENT '原价',
    `weight` decimal(10,1) NOT NULL COMMENT '重量KG',
    `unit_price` decimal(8,2) NOT NULL COMMENT '售价',
    `unit` varchar(60) NOT NULL DEFAULT '' COMMENT '单位',
    `sales` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
    `demand` int(11) NOT NULL DEFAULT '0' COMMENT '最低采购，0为不限制',
    `del_time` int(11) NOT NULL DEFAULT '0' COMMENT '伪删除（0：未删除）',
    PRIMARY KEY (`id`) USING BTREE,
    KEY `goods_id` (`goods_id`) USING BTREE,
    KEY `attribute_type_id` (`attribute_type_id`) USING BTREE,
    KEY `attribute_name` (`attribute_name`) USING BTREE,
    KEY `sales` (`sales`) USING BTREE,
    KEY `del_status` (`del_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品规格';

-- ----------------------------
-- Table structure for tp_goods_brand
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_brand`;
CREATE TABLE `tp_goods_brand` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
    `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺ID',
    `brand_name` varchar(255) DEFAULT NULL COMMENT '品牌名称',
    `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示[1是,0否]',
    `image` varchar(300) DEFAULT NULL COMMENT '类别图片',
    `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
    `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
    PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品品牌';

-- ----------------------------
-- Table structure for tp_goods_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_group`;
CREATE TABLE `tp_goods_group` (
    `group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `agent_id` int(11) NOT NULL DEFAULT '0',
    `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品名称',
    `group_name` varchar(250) DEFAULT NULL COMMENT '属性名称',
    `group_value` varchar(500) DEFAULT NULL COMMENT '属性值',
    PRIMARY KEY (`group_id`) USING BTREE,
    KEY `goods_id` (`goods_id`) USING BTREE,
    KEY `group_name` (`group_name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='商品属性';

-- ----------------------------
-- Table structure for tp_goods_type
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_type`;
CREATE TABLE `tp_goods_type` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
    `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '代理ID',
    `type_name` varchar(255) DEFAULT NULL COMMENT '名称',
    `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父亲id',
    `child` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否存在子id（0.否，1.是）',
    `child_ids` varchar(255) DEFAULT NULL COMMENT '子id（1,2,3,4,5,6,7）',
    `image` varchar(300) DEFAULT NULL COMMENT '类别图片',
    `color` varchar(60) DEFAULT NULL COMMENT '颜色',
    `sort` mediumint(8) NOT NULL DEFAULT '0' COMMENT '排序',
    `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
    `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1显示，0不显示',
    PRIMARY KEY (`id`) USING BTREE,
    KEY `pid` (`pid`) USING BTREE,
    KEY `child` (`child`) USING BTREE,
    KEY `sort` (`sort`) USING BTREE,
    KEY `show` (`show`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商品类别';

SET FOREIGN_KEY_CHECKS = 1;
