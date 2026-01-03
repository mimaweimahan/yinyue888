<?php
/**
 * 事件接口
 */
namespace app\api\controller\v1;

use app\common\model\Event as EventModel;
use app\Request;

class Event
{
    /**
     * 获取事件列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request){
        $limit = $request->param('limit', 10, 'intval'); // 每页数量
        
        $list = EventModel::order(['id' => 'DESC'])
            ->limit($limit)
            ->select()
            ->toArray();
        
        return app('json')->success($list);
    }

    /**
     * 获取事件详情
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request){
        $id = $request->param('id', 0, 'intval');
        
        if(!$id){
            return app('json')->fail('参数错误');
        }
        
        $data = EventModel::find($id);
        
        if(!$data){
            return app('json')->fail('事件不存在');
        }
        
        $data = $data->toArray();
        
        return app('json')->success($data);
    }
}

