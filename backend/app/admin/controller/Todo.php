<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 待开发，停靠点
 */
namespace app\admin\controller;
class Todo extends \app\AdminInit
{
	public function index() {
        return $this->fetch();
	}
}
