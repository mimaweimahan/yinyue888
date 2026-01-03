<?php
/**
 * 条款接口
 */
namespace app\api\controller\v1;

use app\common\model\Clause as ClauseModel;
use app\Request;

class Clause
{
    /**
     * 获取条款列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request){
        $limit = $request->param('limit', 10, 'intval'); // 每页数量
        
        $list = ClauseModel::order(['id' => 'DESC'])
            ->limit($limit)
            ->select()
            ->toArray();
        
        return app('json')->success($list);
    }

    /**
     * 获取条款详情
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request){
        $id = $request->param('id', 0, 'intval');
        
        if(!$id){
            return app('json')->fail('参数错误');
        }
        
        $data = ClauseModel::find($id);
        
        if(!$data){
            return app('json')->fail('条款不存在');
        }
        
        $data = $data->toArray();
        
        return app('json')->success($data);
    }
}

