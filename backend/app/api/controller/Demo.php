<?php
namespace app\api\controller;
use app\common\model\user\UserToken;
use core\utils\Tools;
use think\Exception;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use app\Request;
use think\facade\Lang;

class Demo
{
    public function index(Request $request){
        /*
        Lang::setLangSet('al');
        $bb = Lang::defaultLangSet();
        $cc = Lang::getLangSet();
        $dd = Lang::get('操作成功');
        $ii = Lang::get('登录失败');
        $ee = Lang::get('login.账号或密码错误');
        dump($bb);
        dump($cc);
        dump($dd);
        dump($ee);
        dump($ii);
        */
        $token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ0aXNrdHNob3AuY24iLCJhdWQiOiJ0aXNrdHNob3AuY24iLCJpYXQiOjE3NTY4ODM1MTksIm5iZiI6MTc1Njg4MzUxOSwiZXhwIjoxNzU3MTQyNzE5LCJqdGkiOnsiaWQiOjQsInR5cGUiOiJ1c2VyIn19.YhJKe2jCqR1ZWmmWRZdXh82rtjizGaDtbUBrPRyqbJE';

        $tokenData = UserToken::where('token', $token)->find();
        dump($tokenData);

    }
}