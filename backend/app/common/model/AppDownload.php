<?php
declare (strict_types = 1);
/**
 * Explain: APP下载链接
 */
namespace app\common\model;

use app\common\model\BaseModel;
use app\common\traits\ModelTrait;

class AppDownload extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';
    protected $name = 'app_download';
    use ModelTrait;
}

