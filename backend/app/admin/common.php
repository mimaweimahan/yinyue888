<?php
declare (strict_types = 1);
// 这是系统自动生成的公共文件
use think\facade\Config;
use think\facade\Request;
/**
 * 获取请求用户id
 * @return integer
 */
function admin_user_id()
{
    $admin_user_id_key = Config::get('admin.admin_user_id_key');
    return Request::header($admin_user_id_key, '');
}

/**
 * 获取请求用户token
 *
 * @return string
 */
function admin_token()
{
    $admin_token_key = Config::get('admin.admin_token_key');
    return Request::header($admin_token_key, '');
}

/**
 * 判断用户是否系统管理员
 *
 * @param integer $admin_user_id 用户id
 *
 * @return bool
 */
function is_admin($admin_user_id = 0)
{
    if (empty($admin_user_id)) {
        return false;
    }

    $admin_ids = Config::get('admin.admin_ids', []);
    if (empty($admin_ids)) {
        return false;
    }

    if (in_array($admin_user_id, $admin_ids)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 获取属性类型信息
 * @param string $type
 * @return array
 */
function get_attribute_type($type = '')
{
    // TODO 可以加入系统配置
    static $_type = array(
        'num' => array('数字', 'int(10) UNSIGNED NOT NULL'),
        'string' => array('字符串', 'varchar(255) NOT NULL'),
        'textarea' => array('文本框', 'text NOT NULL'),
        'date' => array('日期', 'int(10) NOT NULL'),
        'datetime' => array('时间', 'int(10) NOT NULL'),
        'bool' => array('布尔', 'tinyint(2) NOT NULL'),
        'select' => array('枚举', 'char(50) NOT NULL'),
        'radio' => array('单选', 'char(10) NOT NULL'),
        'checkbox' => array('多选', 'varchar(100) NOT NULL'),
        'editor' => array('编辑器', 'text NOT NULL'),
        'picture' => array('上传图片', 'int(10) UNSIGNED NOT NULL'),
        'file' => array('上传附件', 'int(10) UNSIGNED NOT NULL'),
    );
    return $type ? $_type[$type][0] : $_type;
}

/**
 * 获取对应状态的文字信息
 * @param int $status
 * @return string 状态文字 ，false 未获取到
 * @author huajie <banhuajie@163.com>
 */
function get_status_title($status = null)
{
    if (!isset($status)) {
        return false;
    }
    switch ($status) {
        case -1:
            return '已删除';
            break;
        case 0:
            return '禁用';
            break;
        case 1:
            return '正常';
            break;
        case 2:
            return '待审核';
            break;
        default :
            return false;
            break;
    }
}


/**
 * 获取数据的状态操作
 * @param $status
 * @return bool|string
 */
function show_status_op($status)
{
    switch ($status) {
        case 0  :
            return '启用';
            break;
        case 1  :
            return '禁用';
            break;
        case 2  :
            return '审核';
            break;
        default :
            return false;
            break;
    }
}

/**
 * 获取文档的类型文字
 * @param string $type
 * @return string 状态文字 ，false 未获取到
 * @author huajie <banhuajie@163.com>
 */
function get_document_type($type = null)
{
    if (!isset($type)) {
        return false;
    }
    switch ($type) {
        case 1  :
            return '目录';
            break;
        case 2  :
            return '主题';
            break;
        case 3  :
            return '段落';
            break;
        default :
            return false;
            break;
    }
}


/**
 * 获取配置的类型
 * @param int $type 配置类型
 * @return string
 */
function get_config_type($type = 0)
{
    $list = getConfig('config_type_list');
    $data = parse_config_attr($list);
    return isset($data[$type])?$data[$type]:'';
}


/**
 * 获取配置的分组
 * @param int $group 配置分组
 * @return string|array
 */
function get_config_group($group = 0)
{
    $list = getConfig('config_group_list');
    $data = parse_config_attr($list);
    return isset($data[$group])?$data[$group]:$data;
}


/**
 * 获取行为类型
 * @param $type int 类型
 * @param bool|false $all 是否返回全部类型
 * @return array
 */
function get_action_type($type = 0, $all = false)
{
    $list = array(
        1 => '系统',
        2 => '用户',
    );
    if ($all) {
        return $list;
    }
    return $list[$type];
}


/**
 * 分析枚举类型配置值 格式 a:名称1,b:名称2
 * @param $string
 * @return array
 */
function parse_config_attr($string) {
    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));
    if(strpos($string,':')){
        $value  =   array();
        foreach ($array as $val) {
            list($k, $v) = explode(':', $val);
            $value[$k]   = $v;
        }
    }else{
        $value  =   $array;
    }
    return $value;
}
