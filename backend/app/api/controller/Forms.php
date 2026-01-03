<?php
namespace app\api\controller;
use app\Request;
use app\admin\model\Forms as FormsModel;
use app\common\model\User;
class Forms
{
    public function index(Request $request){
        $type_id = $request->param('type_id',1,'trim');
        $uid  = $request->uid();
        $nickname = $request->param('nickname','','trim');
        $content = $request->param('content','','trim');
        if(!$content){
            return app('json')->fail('请填写提交内容');
        }
        $user = User::info($uid);
        $data = [
            'uid'=>$uid,
            'type_id'=>$type_id,
            'nickname'=>$nickname?$nickname:$user['nickname'],
            'phone'=>$user['mobile'],
            'content'=>$content,
            'add_time'=>time()
        ];
        if(FormsModel::create($data)){
            return app('json')->success('提交成功');
        }
        return app('json')->fail('提交失败,请稍后再试');
    }
}