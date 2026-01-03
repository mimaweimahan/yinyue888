<?php
namespace app\api\controller\v1;
use app\article\model\Category;
use app\article\model\Article as ArticleModel;
use app\page\model\DiyPage;
use app\page\model\DiyNav;
use app\Request;
class Diy
{
    /**
     * 单页详情
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request){
        $label = $request->param('label','','trim');
        if( empty($label)){
            return app('json')->fail('缺少参数');
        }
        $data = DiyPage::getToArray(['label'=>$label]);
        $data['content'] = htmlspecialchars_decode($data['content']);
        return app('json')->success($data);
    }

    public function page($catdir=''){
        $cat_id = 0;
        if($catdir){
            $cat_id = Category::where(['catdir'=>$catdir])->value('cat_id');
        }
        if($cat_id == 0 ){
            return app('json')->fail('缺少参数');
        }
        $data = ArticleModel::get(['cat_id'=>$cat_id]);
        if(!$data){
            return app('json')->fail('内容不存在');
        }
        return $data->toArray();
    }

    /**
     * 导航
     * @return mixed
     */
    public function nav(){
        $data = DiyNav::getList(['status'=>1],0,'sort asc, id desc');
        return app('json')->success($data);
    }
}