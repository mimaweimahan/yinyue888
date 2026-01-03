<?php
/**
 * 公告接口
 */
namespace app\api\controller\v1;

use app\common\model\Notice as NoticeModel;
use app\Request;

class Notice
{
    /**
     * 获取公告列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request){
        $show_home = $request->param('show_home', 0, 'intval'); // 是否只获取首页公告
        $limit = $request->param('limit', 10, 'intval'); // 每页数量
        
        $where = [
            ['status', '=', NoticeModel::STATUS_SHOW]
        ];
        
        // 如果指定只获取首页公告
        if($show_home == 1){
            $where[] = ['show_home', '=', 1];
        }
        
        $list = NoticeModel::where($where)
            ->order(['sort' => 'ASC', 'id' => 'DESC'])
            ->limit($limit)
            ->select()
            ->toArray();
        
        // 格式化时间
        foreach($list as &$item){
            // 确保时间戳是整数类型
            $item['create_time'] = isset($item['create_time']) && $item['create_time'] > 0 ? (int)$item['create_time'] : 0;
            $item['update_time'] = isset($item['update_time']) && $item['update_time'] > 0 ? (int)$item['update_time'] : 0;
            // 格式化时间文本
            $item['create_time_text'] = $item['create_time'] > 0 ? date('Y-m-d H:i:s', $item['create_time']) : '';
            $item['update_time_text'] = $item['update_time'] > 0 ? date('Y-m-d H:i:s', $item['update_time']) : '';
        }
        
        return app('json')->success($list);
    }

    /**
     * 获取首页公告（只获取首页展示的公告）
     * @param Request $request
     * @return mixed
     */
    public function home(Request $request){
        $limit = $request->param('limit', 5, 'intval'); // 默认返回5条
        
        $list = NoticeModel::where([
            ['status', '=', NoticeModel::STATUS_SHOW],
            ['show_home', '=', 1]
        ])
            ->order(['sort' => 'ASC', 'id' => 'DESC'])
            ->limit($limit)
            ->select()
            ->toArray();
        
        // 格式化时间
        foreach($list as &$item){
            // 确保时间戳是整数类型
            $item['create_time'] = isset($item['create_time']) && $item['create_time'] > 0 ? (int)$item['create_time'] : 0;
            // 格式化时间文本
            $item['create_time_text'] = $item['create_time'] > 0 ? date('Y-m-d H:i:s', $item['create_time']) : '';
        }
        
        return app('json')->success($list);
    }

    /**
     * 获取公告详情
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request){
        $id = $request->param('id', 0, 'intval');
        
        if(!$id){
            return app('json')->fail('参数错误');
        }
        
        $data = NoticeModel::where([
            ['id', '=', $id],
            ['status', '=', NoticeModel::STATUS_SHOW]
        ])->find();
        
        if(!$data){
            return app('json')->fail('公告不存在或已下架');
        }
        
        $data = $data->toArray();
        // 确保时间戳是整数类型
        $data['create_time'] = isset($data['create_time']) && $data['create_time'] > 0 ? (int)$data['create_time'] : 0;
        $data['update_time'] = isset($data['update_time']) && $data['update_time'] > 0 ? (int)$data['update_time'] : 0;
        // 格式化时间文本
        $data['create_time_text'] = $data['create_time'] > 0 ? date('Y-m-d H:i:s', $data['create_time']) : '';
        $data['update_time_text'] = $data['update_time'] > 0 ? date('Y-m-d H:i:s', $data['update_time']) : '';
        
        return app('json')->success($data);
    }
}

