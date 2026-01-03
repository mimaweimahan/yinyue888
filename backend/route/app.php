<?php
use think\facade\Route;
use think\Request;
Route::get('detail/:id', 'article/index/view');
Route::get('detail/:id', 'article/index/view');
Route::get('search/:w','\app\index\controller\Index@search');
Route::get('search_page/:w/:page','\app\index\controller\Index@search');
Route::miss(function() {
    return \think\Response::create()->code(404);
});