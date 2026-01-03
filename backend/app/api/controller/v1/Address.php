<?php
/**
 * 用户地址
 */
namespace app\api\controller\v1;
use app\Request;
use app\common\model\user\UserAddress;
use app\common\validate\Address as AddressVal;
class Address
{
    /**
     * 地址
     * @param Request $request
     * @return mixed
     */
    public function query(Request $request){
        $uid  = $request->uid();
        $list = UserAddress::getList(['uid'=>$uid,'del_time'=>0],0,'is_default desc, id desc');
        return app('json')->success($list);
    }

    /**
     * 添加
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request){
        $param = $request->param();
        $uid = $request->uid();
        $param['uid']= $uid;
        // 验证数据
        $validate = validate(AddressVal::class,[],false,false);
        if( !$validate->check($param) ){
            return app('json')->fail($validate->getError());
        }
        $param['add_time']= time();
        if(UserAddress::create($param)){
            $list = UserAddress::getList(['uid'=>$uid,'del_time'=>0],0,'is_default desc, add_time desc,id desc');
            return app('json')->success('添加成功',$list);
        }
        return app('json')->fail('缺少参数');
    }

    /**
     * 编辑
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request){
        $param = $request->param();
        $uid = $request->uid();
        $address_id = $request->param('address_id',0,'intval');
        $param['uid'] = $uid;
        // 验证数据
        $validate = validate(AddressVal::class,[],false,false);
        if( !$validate->check($param) ){
            return app('json')->fail($validate->getError());
        }
        unset($param['address_id']);
        if(UserAddress::update($param,['uid'=>$uid,'id'=>$address_id])){
            $list = UserAddress::getList(['uid'=>$uid,'del_time'=>0],0,'is_default desc, add_time desc,id desc');
            return app('json')->success('更新成功',$list);
        }
        return app('json')->fail('更新失败，请稍后再试');
    }

    /**
     * 删除
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request){
        $uid = $request->uid();
        $address_id = $request->param('address_id',0,'intval');
        if($address_id == 0){
            return app('json')->fail('缺少参数');
        }
        if(UserAddress::destroy(['uid'=>$uid,'id'=>$address_id])){
            return app('json')->success('操作成功');
        }
        return app('json')->fail('删除失败，亲稍后再试');
    }

    /**
     * 设为默认
     * @param Request $request
     * @return mixed
     */
    public function default(Request $request){
        $uid = $request->uid();
        $address_id = $request->param('address_id',0,'intval');
        if($address_id == 0){
            return app('json')->fail('缺少参数');
        }
        UserAddress::update(['is_default'=>0],['uid'=>$uid]);
        if(UserAddress::update(['is_default'=>1],['uid'=>$uid,'id'=>$address_id])){
            return app('json')->success('操作成功');
        }
        return app('json')->fail('删除失败，亲稍后再试');
    }
}