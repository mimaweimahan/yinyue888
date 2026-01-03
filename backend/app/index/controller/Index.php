<?php

namespace app\index\controller;

use app\Base;

class Index  extends Base
{
    public function index(){
        header("Location: /h5/");
        exit;
        //return $this->fetch();
    }
}