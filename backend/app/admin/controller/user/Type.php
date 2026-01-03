<?php
declare (strict_types = 1);
namespace app\admin\controller\user;
use app\common\traits\ControllerTrait;
use app\common\model\user\UserType;
use core\utils\Tools;
class Type extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new UserType();
    }
    use ControllerTrait;
    /**
     * 新增
     * @return mixed
     */
    public function add(){
        if( $this->request->isPost() ){
            $names = explode("\n", $_POST['name']);
            if(empty($names)) {
                $this->error("信息不完整");
            }
            $suc = [];
            foreach ($names as $name) {
                $data["name"] = Tools::strSpace($name);
                $suc[] = UserType::create($data);
            }
            return self::success('新增'.count($suc).'个');
        }
        return $this->fetch();
    }
}