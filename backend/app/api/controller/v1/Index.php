<?php
namespace app\api\controller\v1;
use app\Request;
use app\swiper\model\Swiper;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
class Index
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
        $tab = $request->param('tab','mp_index','trim');
        $map[] = ['tab','=',$tab];
        $map[] = ['status','=',1];
        $banner = Swiper::getToArray($map);
        $swiper = [];
        if($banner){
            $swiper = $banner['swiper'];
        }
        $app_name = getConfig('config_app_name');
        $app_logo = getConfig('config_logo_url');

        $data = [
            'app_name'=>$app_name,
            'app_logo'=>$app_logo,
            'swiper'=> $swiper,//轮播图

        ];
        return app('json')->success($data);
    }



    /**
     * 获取轮播图
     * @param Request $request
     * @return mixed
     */
    public function swiper(Request $request){
        $tab  = $request->param('tab');
        if($tab == ''){
            return app('json')->fail('缺少调用标签');
        }
        $map[] = ['tab','=',$tab];
        $map[] = ['status','=',1];
        $data  = Swiper::get($map);
        $swiper = [];
        if($data){
            $data   = $data->toArray();
            $swiper = $data['swiper'];
        }
        return app('json')->success($swiper);
    }


}