-- APP下载链接管理菜单
-- 注意：执行此SQL前，请先确认 admin/index/module 菜单的ID，如果不存在请先创建
-- 此SQL假设 admin/index/module 的ID为某个值，实际使用时需要根据实际情况调整 pid

-- 获取 admin/index/module 的ID作为父菜单ID
SET @parent_id = (SELECT id FROM `tp_auth_rule` WHERE `name` = 'admin/index/module' LIMIT 1);

-- 如果找不到父菜单，则使用0（顶级菜单）
SET @parent_id = IFNULL(@parent_id, 0);

-- 插入主菜单
INSERT INTO `tp_auth_rule` (`pid`, `module`, `type`, `name`, `title`, `show`, `condition`, `sort`, `icon`, `create_time`, `update_time`) 
VALUES 
(@parent_id, 'admin', 1, 'admin/app_download/index', 'APP下载链接', 1, '', 100, '', UNIX_TIMESTAMP(), UNIX_TIMESTAMP())
ON DUPLICATE KEY UPDATE `title` = 'APP下载链接', `update_time` = UNIX_TIMESTAMP();

-- 获取刚插入的菜单ID
SET @menu_id = (SELECT id FROM `tp_auth_rule` WHERE `name` = 'admin/app_download/index' LIMIT 1);

-- 插入子菜单（如果不存在）
INSERT INTO `tp_auth_rule` (`pid`, `module`, `type`, `name`, `title`, `show`, `condition`, `sort`, `icon`, `create_time`, `update_time`) 
VALUES 
(@menu_id, 'admin', 1, 'admin/app_download/add', '新增', 0, '', 0, '', UNIX_TIMESTAMP(), UNIX_TIMESTAMP()),
(@menu_id, 'admin', 1, 'admin/app_download/edit', '编辑', 0, '', 0, '', UNIX_TIMESTAMP(), UNIX_TIMESTAMP()),
(@menu_id, 'admin', 1, 'admin/app_download/del', '删除', 0, '', 0, '', UNIX_TIMESTAMP(), UNIX_TIMESTAMP())
ON DUPLICATE KEY UPDATE `update_time` = UNIX_TIMESTAMP();

