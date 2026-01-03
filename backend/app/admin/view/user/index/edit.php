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
    <title>编辑</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <div class="layui-card-body">
        <form class="layui-form" action="{:url('edit')}" method="post">
            <input type="hidden" name="id" value="{$id}" />
            <div class="layui-row layui-col-space15">
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">业务员</span>
                        <span class="color-desc margin-left-5">Worker ID</span>
                        <span class="color-desc"></span>
                        <select name="worker_id" id="worker_id" class="layui-select">
                            <option value="">请选择</option>
                            {volist name="salesman_list" id="r"}
                                {if $r.worker_id==$worker_id}
                                    <option value="{$r.worker_id}" selected>[{$r.worker_id}]{$r.worker_user}</option>
                                {else/}
                                    <option value="{$r.worker_id}">[{$r.worker_id}]{$r.worker_user}</option>
                                {/if}
                            {/volist}
                        </select>
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">国际区号</span>
                        <span class="color-desc margin-left-5">Code</span>
                        <input type="text" name="country_code" value="{$country_code}"  lay-verify="required"  placeholder="请填国际区号" class="layui-input">
                        <span class="color-desc"></span>
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">手机号</span>
                        <span class="color-desc margin-left-5">Mobile</span>
                        <input type="text" name="phone" value="{$phone}"  lay-verify="required"  placeholder="请填手机号" class="layui-input">
                        <span class="color-desc"></span>
                    </label>
                </div>
            </div>
            <div class="layui-row layui-col-space15">
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">用户名</span>
                        <span class="color-desc margin-left-5">UserName</span>
                        <input type="text" name="nickname" value="{$nickname}" lay-verify="required" placeholder="请输入登录名" class="layui-input">
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">邮箱</span>
                        <span class="color-desc margin-left-5">Email</span>
                        <input type="text" name="email" value="{$email}" lay-verify="required"  placeholder="请输入邮箱" class="layui-input">

                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">邀请人ID</span>
                        <span class="color-desc margin-left-5">Invite</span>
                        <input type="text" name="referee_id" value="{$referee_id}" placeholder="请填邀请人" class="layui-input">
                        <span class="color-desc">填写邀请人会关联业务员及代理</span>
                    </label>
                </div>
            </div>
            <div class="layui-row layui-col-space15">
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">登录密码</span>
                        <span class="color-desc margin-left-5">PassWord</span>
                        <input type="password" name="password" value="" placeholder="请输入登录密码" class="layui-input">
                        <span class="color-desc">若不修改，请留空：{$password}</span>
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">交易密码</span>
                        <span class="color-desc margin-left-5">trans_password</span>
                        <input type="password" name="trans_password" value="" autocomplete="off" placeholder="请输入交易密码" class="layui-input">
                        <span class="color-desc">若不修改，请留空：{$trans_password}</span>
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">状态</span>
                        <span class="color-desc margin-left-5">Status</span>
                        <select name="status">
                            <option value="1" {if $status==1} selected {/if}>正常</option>
                            <option value="0" {if $status==0} selected {/if}>禁止</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="layui-row layui-col-space15">
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">任务单数</span>
                        <span class="color-desc margin-left-5">Task Num</span>
                        <input type="number" name="task_num" value="{$task_num}" placeholder="请输入任务单数" class="layui-input">
                        <span class="color-red" >非必要不修改</span>
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">完成单数</span>
                        <span class="color-desc margin-left-5">Task Done</span>
                        <input type="number" name="task_done" value="{$task_done}" autocomplete="off" placeholder="请输入完成单数" class="layui-input">
                        <span class="color-red">非必要不修改</span>
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">任务利率</span>
                        <span class="color-desc margin-left-5">Task Rate</span>
                        <input type="number" name="task_rate" value="{$task_rate}" autocomplete="off" placeholder="请输入任务利率" class="layui-input">
                        <span class="color-red">%</span>
                    </label>
                </div>
            </div>
            <div class="layui-row layui-col-space15">
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">信誉分</span>
                        <span class="color-desc margin-left-5">Credit Score</span>
                        <input type="number" name="credit_score" value="{$credit_score}" placeholder="请输入信誉分"
                            class="layui-input">
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">信誉分单价</span>
                        <span class="color-desc margin-left-5">Task Done</span>
                        <input type="number" name="credit_usdt" value="{$credit_usdt}" autocomplete="off" placeholder="信誉分单价"
                            class="layui-input">
                    </label>
                </div>
                <div class="layui-col-xs4"></div>
            </div>
            <div class="layui-row layui-col-space15">
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">可否提现</span>
                        <span class="color-desc margin-left-5">Is Withdraw</span>
                        <select name="is_withdraw">
                            <option value="0" {if $is_withdraw==0} selected {/if}>允许</option>
                            <option value="1" {if $is_withdraw==1} selected {/if}>禁止</option>
                        </select>
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">限制提示</span>
                        <span class="color-desc margin-left-5">Withdraw Notice</span>
                        <input type="text" name="withdraw_notice" value="{$withdraw_notice}" autocomplete="off" placeholder="请输入限制提示" class="layui-input">
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">备注</span>
                        <span class="color-desc margin-left-5">Remark</span>
                        <input type="text" name="remark" value="{$remark}" placeholder="请填备注" class="layui-input">
                    </label>
                </div>
            </div>
            <div class="layui-row layui-col-space15">
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">提现地址</span>
                        <span class="color-desc margin-left-5">Withdraw Address</span>
                        <input type="text" name="address_withdraw" value="{$address_withdraw}" autocomplete="off" placeholder="请输入提现地址" class="layui-input">
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">自动打款</span>
                        <span class="color-desc margin-left-5">Auto Paid</span>
                        <select name="is_auto_paid">
                            <option value="0" {if $is_auto_paid==0} selected {/if}>否</option>
                            <option value="1" {if $is_auto_paid==1} selected {/if}>是</option>
                        </select>
                        <span class="red">*自动打款类型为限定用户才生效</span>
                    </label>
                </div>
                <div class="layui-col-xs4">
                    <label class="relative block">
                        <span class="color-green font-w7">邀请权限</span>
                        <span class="color-desc margin-left-5">invite</span>
                        <select name="is_invite">
                            <option value="0" {if $is_invite==0} selected {/if}>允许</option>
                            <option value="1" {if $is_invite==1} selected {/if}>禁止</option>
                        </select>
                        <span class="red"></span>
                    </label>
                </div>
            </div>
            <div style="height: 80px"></div>
            <div class="layui-body-footer">
                <button type="submit" class="layui-btn layui-btn-primary layui-btn-md" lay-submit lay-filter="submit_btn">提交</button>
                <button type="reset" class="layui-btn layui-btn-md">重置</button>
            </div>
        </form>
    </div>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('edit')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { location.reload(); },3000);
                    }
                }
            });
            return false;
        });
        $('#bak-btn').on('click',function () {
            layer.closeAll();
        });
    });
</script>
</body>
</html>
