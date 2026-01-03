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
    <title>管理登录</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <style type="text/css">
        html,body{
            height: 100%;
            background: url("{__STATIC__}/admin/login_bg.jpg") 50% no-repeat #f1f4fd;
            background-size: cover;
        }
        #login-bg{ width: 100%; height: 100%; position:fixed; z-index: 1; top:0; left: 0;  background: rgba(0, 0, 0, 0.6); }
        #login-box{ width: 100%; height: 100%; position: relative; z-index: 10; display: flex; justify-content:center;  align-items:center;  text-align: center;}
        #login-box h2{ text-align: center; font-size: 2.0rem; height:4rem; line-height:4rem; color: #fff; }
        #login-box>div{ background: #fff; width:80%;max-width:400px; margin:0 auto; border-radius:5px; min-height:420px; box-shadow:0 0 30px rgba(0, 0, 0, 0.1);}
        #login-box>div form{ padding:40px;}
        #login-box .form-item label{ color:#444; font-weight: bold; display: block; width: 100%; line-height:50px; text-align: left;}
         #login-box .logo{ padding:20px 0}
        #login-box p{ padding:30px 0 0 0;}
        #login-box p a{ color: #666;}
        #login-box p a:hover{ color:#1E9FFF; text-decoration:underline;}
        .layui-input{
            height:40px;
            line-height: 1.3;
            color: #666;
        }
        @media screen and (max-width: 450px){
            #login-box{top:5%;}
            #login-box h2{height:6rem;line-height:6rem;}
        }
        #verify-box{ position: relative;}
        #verify-box .layui-input{ height:50px;}
        #verify-box img{ position: absolute; top:1px; right:1px; cursor: pointer}
        @media screen and (max-width: 450px){
            #login-box{top:2%!important;}
            #login-box>div form{ padding:30px 20px;}
            #sms_verify_box .form-item{margin:40% auto;}
            #login-box>div{ width: 90%;}
        }
        #user_btn{ width: 100%; height:50px; line-height:50px; }
    </style>
</head>
<body>
<div id="login-bg"></div>
<div id="login-box">
    <div>
        <form class="layui-form" action="" method="post">
            <div class="logo">
                <img src="{:getConfig('config_logo_url')}" width="50%"/>
            </div>
            <div class="form-item">
                <label for="user_name">用户账号</label>

                <input type="text" name="user_name" id="user_name"  placeholder="请输入账号或手机号" autocomplete="off" class="layui-input">
            </div>
            <div class="form-item">
                <label for="user_pass">登录密码</label>
                <input type="password" name="user_pass" id="user_pass"  placeholder="请输入登录密码" autocomplete="off" class="layui-input">
            </div>
            <div class="form-item" id="google-auth-form" >
                <label for="google_auth">谷歌验证码</label>
                <input type="text" name="google_auth" id="google_auth"  placeholder="没有绑定不需要填写" autocomplete="off" class="layui-input">
            </div>
            <div class="form-item" id="verify-form" <?php if($verify_lock < 3){ echo 'style="display: none"';} ?> >
                <label for="verify">验证码</label>
                <div id="verify-box">
                    <input type="text" name="verify" id="verify" placeholder="请输入验证码" autocomplete="off" class="layui-input">
                    <img src="{:url('tool/verify/index',['w'=>120,'h'=>45,'f'=>15])}" alt="验证码" id="verify_img_url" width="120" height="48"/>
                </div>
            </div>
            <div style="margin-top:30px;">
                <button type="submit" class="layui-btn layui-btn-radius layui-bg-black" id="user_btn" lay-submit lay-filter="user_form">确定登录</button>
            </div>
        </form>
    </div>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['layer','jquery','form'], function(){
        var form = layui.form ,layer = layui.layer ,$ = layui.jquery;
        $('#verify_img_url').on('click',function () {
            $(this).attr("src","{:url('tool/verify/index',['w'=>120,'h'=>45,'f'=>15])}&num="+Math.random());
        });
        form.on('submit(user_form)', function(data){
            var btn  = $('#user_btn');
            console.log(data);
            if (!data.field.user_name){
                layer.msg('请填写你的手机号');
                return false;
            }
            if (!data.field.user_pass){
                layer.msg('请填写登录密码');
                return false;
            }
            $.ajax({
                url:"{:url('login')}",
                type:'post',
                data:data.field,
                dataType:"json",
                beforeSend:function(){
                    var text = btn.text();
                    btn.text(text + '中...').prop('disabled', true).addClass('disabled');
                },
                success:function(data){
                    var text = btn.text();
                    //按钮文案、状态修改
                    btn.removeClass('disabled').text(text.replace('中...', ''));
                    layer.msg(data.msg);
                    if(data['data']=='3'){
                        $("#verify-form").show();
                    }
                    if (data.code ==1) {
                        setInterval(function(){
                            window.location.href = "{:url('admin/index/index')}";
                        },3000);
                    } else{
                        btn.removeProp('disabled').removeClass('disabled');
                    }
                },
                error:function(e){
                    layer.msg(data.msg);
                },

            });
            return false;
        });

    });
</script>
</body>
</html>