<?php /*a:1:{s:59:"/www/wwwroot/tisktshop.com/app/agent/view/index/updated.php";i:1762348990;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>更新资料</title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>更新资料</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form" method="post" action="<?php echo url('updated'); ?>">
                <div class="form-item">
                    <label for="idd" class="form-label">ID</label>
                    <div class="input-inline">
                        <input type="text"  value="<?php echo html_entities($agent_id); ?>" id="idd" disabled class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="username" class="form-label">登录账号</label>
                    <div class="input-inline">
                        <input type="text" value="<?php echo html_entities($username); ?>" id="username" disabled class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="nickname" class="form-label">用户名称</label>
                    <div class="input-inline">
                        <input type="text" name="nickname" value="<?php echo html_entities($nickname); ?>" id="nickname" placeholder="用户名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="telegram" class="form-label">Telegram(客服号)</label>
                    <div class="input-inline">
                        <input type="text" name="telegram" value="<?php echo html_entities($telegram); ?>" id="telegram" placeholder="Telegram客服号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="rate" class="form-label">我的费率</label>
                    <div class="input-inline">
                        <input type="text" value="<?php echo html_entities($rate); ?>" id="rate" disabled class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="rate" class="form-label">提现自动打款</label>
                    <div class="input-inline">
                        <div style="width: 180px">
                            <select name="is_auto_paid" id="is_auto_paid" class="layui-select">
                                <option value="0" <?php if($is_auto_paid == 0): ?> selected <?php endif; ?>>禁止</option>
                                <option value="1" <?php if($is_auto_paid == 1): ?> selected <?php endif; ?>>开启</option>
                            </select>
                        </div>
                        <div class="form-tips"> * 普通用户提现自动打款</div>
                    </div>
                </div>
                <div class="form-item">
                    <label for="max_paid_amount" class="form-label">自动打款限额</label>
                    <div class="input-inline">
                        <input type="text" name="max_paid_amount" value="<?php echo html_entities($max_paid_amount); ?>" id="max_paid_amount" placeholder=" 填写0为不限制 " autocomplete="off" class="layui-input" />
                        <div class="form-tips"> * 提现自动打款最大值</div>
                    </div>
                </div>
                <div class="form-item">
                    <label for="cpassword" class="form-label">当前密码</label>
                    <div class="input-inline">
                        <input type="text" name="cpassword" id="cpassword" placeholder=" 请填写当前登陆密码 " autocomplete="off" class="layui-input" />
                        <div class="form-tips"> * 不修改请留空</div>
                    </div>
                </div>
                <div class="form-item">
                    <label for="npassword" class="form-label">新密码</label>
                    <div class="input-inline">
                        <input type="text" name="npassword" id="npassword" placeholder=" 不修改请留空 " autocomplete="off" class="layui-input" />
                        <div class="form-tips"> * 不修改请留空</div>
                    </div>
                </div>
                <div class="form-item">
                    <label for="npassword2" class="form-label">确认新密码</label>
                    <div class="input-inline">
                        <input type="text" name="npassword2" id="npassword2" placeholder=" 不修改请留空 " autocomplete="off" class="layui-input" />
                        <div class="form-tips"> * 不修改请留空</div>
                    </div>
                </div>
                <div class="footer-btn-box">
                    <div >
                        <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">保存以上设置</button>
                        <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.back()">返回</button>
                    </div>
                </div>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"<?php echo url('updated'); ?>",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        location.reload();
                    }
                }
            });
            return false;
        });

    });
</script>
</body>
</html>