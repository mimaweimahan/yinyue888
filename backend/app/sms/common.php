<?php
/**
 * 短信发送状态
 * @param int $status
 * @return string
 */
function sms_status($status = 0){
    switch ($status){
        case 1;
            return '已发送';
        case 2;
            return '发送成功';
        case 3;
            return '发送失败';
        default:
            return '未发送';
    }
}
