<?php
// +----------------------------------------------------------------------
// | TT[ 管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020~2030 https://www.x.com All rights reserved
// +----------------------------------------------------------------------
// | Licensed TT[管理系统]并不是自由软件，未经许可不能去掉TT相关版权及二次开发
// +----------------------------------------------------------------------
// | Author: TT
// +----------------------------------------------------------------------
namespace app\common\traits;
trait ErrorTrait
{
    /**
     * 错误信息
     * @var string
     */
    protected $error;

    /**
     * 设置错误信息
     * @param string|null $error
     * @return bool
     */
    protected function setError(?string $error = null)
    {
        $this->error = $error ?: '未知错误';
        return false;
    }

    /**
     * 获取错误信息
     * @return string
     */
    public function getError()
    {
        $error = $this->error;
        $this->error = null;
        return $error;
    }
}
