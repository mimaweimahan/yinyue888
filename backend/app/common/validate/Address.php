<?php
namespace app\common\validate;
use think\Validate;
/**
 * 收货验证
 */
class Address extends Validate
{
    protected $regex = ['phone'=>'/^1[3456789]\d{9}$/'];
    protected $rule = [
        'uid'=>'require',
        'username'=>'require',
        'phone'=>'require|regex:phone',
        'address'=>'require',
        'street'=>'require'
    ];
    protected $message  =   [
        'uid.require'=>'缺少必须要参数',
        'username.require'=>'收货人姓名必须填写',
        'phone.require'   =>'手机号必须填写',
        'phone.regex'     =>'手机号格式错误',
        'address.require' =>'省市区必须填写',
        'street.require'  =>'街道必须填写'
    ];
}