<?php
namespace addons\ueditor\controller;
use think\facade\Config;
class Index extends \app\Init
{
    public function index(){
        return $this->fetch();
    }
}