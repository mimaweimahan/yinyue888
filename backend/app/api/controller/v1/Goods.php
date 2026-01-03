<?php
namespace app\api\controller\v1;
use app\goods\model\Goods as GoodsModel;
use app\Request;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use core\utils\Tools;
class Goods
{
    /**
     * 首页数据
     * @param Request $request
     * @return mixed
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function index(Request $request){
        $limit = $request->param('limit',20,'intval');
        $data = GoodsModel::where(['del_time'=>0])->limit($limit)->orderRand()->select()->toArray();
        return app('json')->success($data);
    }

    public function trading(Request $request){
        $limit = $request->param('limit',40,'intval');
        $data = GoodsModel::where(['del_time'=>0])->field('id,title,image,price')->limit($limit)->orderRand()->select()->toArray();
        return app('json')->success($data);
    }
}