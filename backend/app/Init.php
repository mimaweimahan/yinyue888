<?php
declare (strict_types = 1);
namespace app;
use think\App;
use think\db\exception\ModelNotFoundException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\facade\View;
use think\Response;
use think\Validate;
use app\admin\model\Config;
/**
 * 控制器基础类
 */
abstract class Init
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;
    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    protected $config;

    /**
     * 构造方法
     * Base constructor.
     * @param App $app 应用对象
     * @throws ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;
        // 控制器初始化
        $this->initialize();
    }

    /**
     * 初始化
     * @throws ModelNotFoundException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     */
    protected function initialize()
    {
        $app_config = Config::setConfig();
        $this->config = $app_config;
        $this->assign('config',$app_config);
    }

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }
        return $v->failException(true)->check($data);
    }

    /**
     * 视图赋值
     * @param mixed ...$vars
     */
    protected function assign(...$vars)
    {
        View::assign(...$vars);
    }

    /**
     * 返回视图
     * @param string $template
     * @return string
     */
    protected function fetch(string $template = '')
    {
        return View::fetch($template);
    }

    /**
     * 页面
     * @param mixed ...$args
     */
    protected function redirect(...$args){
        throw new HttpResponseException(redirect(...$args));
    }
    /**
     * 错误提醒页面
     * @param string $msg
     * @param int $url
     * @return string
     */
    public function error($msg = '哎呀…亲…您访问的页面出现错误', $url = 3)
    {
        if($this->request->isAjax()){
           return app("json")->fail($msg,$url);
        }else{
            $this->assign(compact('msg','url'));
            $response = Response::create($this->fetch('admin@public/error'));
            throw new HttpResponseException($response);
        }
    }

    /**
     * 成功提醒页面
     * @param string $msg
     * @param string $url
     * @param int $wait
     * @return string
     */
    public function success($msg, $url = '',$wait = 5)
    {
        if($this->request->isAjax()){
            return app("json")->success($msg,$url);
        }else{
            if(!$url){
                $url = 'javascript:history.back(-1);';
            }
            $this->assign(compact('msg','url','wait'));
            $response = Response::create($this->fetch('admin@public/success'));
            throw new HttpResponseException($response);
        }
    }

    /**
     * 异常抛出
     * @param string $msg
     */
    protected function exception($msg = '无法打开页面')
    {
        $this->assign(compact('msg'));
        $response = Response::create($this->fetch('admin@public/exception'));
        throw new HttpResponseException($response);
    }

    /**
     * layui
     * @param array $data
     * @param array $attach 附加数据
     * @return \think\response\Json
     */
    public static function result_layui($data = [],$attach=[])
    {
        $_return = ['code'=>0,'data'=>[],'page'=>0, 'limit'=>20, 'attach'=>$attach];

        if(isset($data['total'])){
            $_return['count'] = $data['total'];
        }else{
            $_return['data']  = $data;
            $_return['count'] = count($data);
        }

        if(isset($data['data'])){
            $_return['data'] = $data['data'];
        }
        if(isset($data['per_page'])){
            $_return['limit'] = $data['per_page'];
        }
        if(isset($data['current_page'])){
            $_return['page'] = $data['current_page'];
        }
        return json($_return);
    }
}
