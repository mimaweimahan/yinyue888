<?php
/**
 * APP下载链接接口
 */
namespace app\api\controller\v1;

use app\common\model\AppDownload as AppDownloadModel;
use app\Request;

class AppDownload
{
    /**
     * 获取APP下载链接列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request){
        $limit = $request->param('limit', 10, 'intval'); // 每页数量
        
        $list = AppDownloadModel::order(['id' => 'DESC'])
            ->limit($limit)
            ->select()
            ->toArray();
        
        return app('json')->success($list);
    }
}

