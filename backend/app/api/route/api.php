<?php
use think\facade\Route;
use app\common\middleware\AllowCrossDomain;
use app\api\middleware\AuthTokenMiddleware;
use app\api\middleware\LangMiddleware;

Route::group(function () {
    Route::rule('demo/index', 'Demo/index');
    //获取首页数据
    Route::rule('user/login', 'Login/index');
    Route::rule('user/register', 'Login/register');
    Route::rule('user/logout', 'Login/logout');
    Route::rule('upload/image', 'v1.upload/image');
    
    // 全局公告接口（公开访问，无需登录）
    Route::rule('notice/index', 'v1.notice/index'); // 获取公告列表
    Route::rule('notice/home', 'v1.notice/home'); // 获取首页公告
    Route::rule('notice/detail', 'v1.notice/detail'); // 获取公告详情
    
    // APP下载链接接口（公开访问，无需登录）
    Route::rule('app_download/index', 'v1.app_download/index'); // 获取APP下载链接列表
    
    // 条款接口（公开访问，无需登录）
    Route::rule('clause/index', 'v1.clause/index'); // 获取条款列表
    Route::rule('clause/detail', 'v1.clause/detail'); // 获取条款详情
    
    // 事件接口（公开访问，无需登录）
    Route::rule('event/index', 'v1.event/index'); // 获取事件列表
    Route::rule('event/detail', 'v1.event/detail'); // 获取事件详情
    
    // 关于我们接口（公开访问，无需登录）
    Route::rule('about/index', 'v1.about/index'); // 获取关于我们列表
    Route::rule('about/detail', 'v1.about/detail'); // 获取关于我们详情
    
    // 客服接口（公开访问，无需登录；登录用户可获取个性化客服链接）
    // 使用可选的认证中间件，允许未登录访问，但登录用户可获取个性化客服
    Route::rule('v1.user/kf', 'v1.user/kf')->middleware(AuthTokenMiddleware::class, false); // 获取客服链接
})->middleware(LangMiddleware::class)->middleware(AllowCrossDomain::class);

//+会员登录认证
Route::group(function () {
    Route::rule('goods/index', 'v1.goods/index');
    Route::rule('goods/trading', 'v1.goods/trading');
    Route::rule('trading/dynamics', 'v1.trading/dynamics');
    Route::rule('trading/info', 'v1.trading/info'); //抢单首页
    Route::rule('trading/create', 'v1.trading/createOrder'); //创建订单
    Route::rule('trading/confirm', 'v1.trading/confirm'); //确认订单
    Route::rule('trading/list', 'v1.trading/list'); //我的订单

    Route::rule('wallet/info', 'v1.wallet/info');
    Route::rule('wallet/out', 'v1.Withdrawal/out');//提现申请
    Route::rule('wallet/log', 'v1.wallet/log');// 账户记录

    Route::rule('v1.user/info', 'v1.user/info');
    Route::rule('v1.user/notice', 'v1.user/notice');
    Route::rule('v1.user/see_notice', 'v1.user/seeNotice');
    Route::rule('v1.user/index', 'v1.user/index');
    Route::rule('v1.user/setaddress', 'v1.user/setaddress');
    Route::rule('v1.user/pwd', 'v1.user/pwd');//修改密码
    Route::rule('v1.user/pin', 'v1.user/pin');//修改交易密码

    Route::rule('v1.team/index', 'v1.Team/index');//团队首页
    Route::rule('v1.team/lst', 'v1.Team/lst');//团队离别
    Route::rule('v1.recharge/index', 'v1.recharge/index');//充值
    Route::rule('v1.recharge/approval', 'v1.recharge/approval');//充值凭证提交

    //用户账户
    Route::rule('v1.user/account', 'v1.user/accountList');

})->middleware(LangMiddleware::class)
->middleware(AllowCrossDomain::class)
->middleware(AuthTokenMiddleware::class, true);

Route::miss(function() {
    app('json')->fail('Page not found');
});
