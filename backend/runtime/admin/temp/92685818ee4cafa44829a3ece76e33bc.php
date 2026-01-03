<?php /*a:1:{s:57:"/www/wwwroot/tisktshop.com/app/admin/view/index/index.php";i:1762846080;}*/ ?>
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
    <title><?php echo html_entities($config['config_app_name']); ?></title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="layui-layout-body sys-admin">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">
            <a href="javascript:void(0);" class="logo">
                <!-- 迷你模式下Logo的大小为50X50 -->
                <span class="logo-mini"><img src="<?php echo getConfig('config_logo_sys'); ?>" width="40" /></span>
                <!-- 普通模式下Logo -->
                <span class="logo-lg"><img src="<?php echo getConfig('config_logo_sys'); ?>" height="100%" /></span>
            </a>
        </div>
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item mini-left-ck">
                <a href="javascript:void(0);" class="to-mini">
                    <i class="layui-icon layui-icon-shrink-right"></i>
                </a>
                <a href="javascript:void(0);" class="to-max">
                    <i class="layui-icon layui-icon-spread-left"></i>
                </a>
            </li>
            <li class="layui-nav-item"><a href="<?php echo url('admin/index/index'); ?>">控制台</a></li>
        </ul>
        <ul class="layui-nav layui-layout-right ">
            <li class="layui-nav-item">
                <a href="javascript:void(0);" >
                    <img src="<?php echo url('tool/avatar/index',['uid'=>$admin_info['uid']]); ?>" class="layui-nav-img layui-hide-xs">
                    <i class="layui-hide-xs"><?php echo html_entities($admin_info['nickname']); ?></i>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="<?php echo url('admin/admin/update'); ?>" target="main">基本资料</a></dd>
                    <dd><a href="<?php echo url('admin/index/cache'); ?>" target="main">清除缓存</a></dd>
                    <dd><a href="<?php echo url('admin/admin/binding'); ?>?id=<?php echo html_entities($admin_id); ?>" target="main">绑定谷歌</a></dd>
                    <dd><a href="<?php echo url('admin/login/signout'); ?>">安全退出</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    <div class="left-user-box">
        <a href="<?php echo url('admin/admin/update'); ?>" target="main">
            <img src="<?php echo url('tool/avatar/index',['uid'=>$admin_info['uid']]); ?>" class="layui-nav-img">
            <dl>
                <dd><?php echo html_entities($admin_info['nickname']); ?></dd>
                <dt><?php echo html_entities($admin_info['phone']); ?></dt>
            </dl>
        </a>
    </div>
    <div class="layui-side layui-bg-black left-nav">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-diy layui-nav-tree" lay-shrink="all" lay-filter="left-nav">加载中...</ul>
        </div>
    </div>
    <div class="layui-body">
        <div class="main-panel" style="width:100%; height: 100%;">
            <iframe src="<?php echo url('main'); ?>" name="main" id="frame-main" width="100%" height="100%" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling-x="no" scrolling-y="auto" allowtransparency="yes"></iframe>
        </div>
    </div>
</div>
<script id="left_tpl" type="text/html">
    {{#  layui.each(d, function(k,r){ }}
        <li class="layui-nav-item">
            {{#  if(r.items){ }}
            <a href="javascript:void(0);">
                {{#  if(r.icon){ }}
                <i class="left-icon iconfont">&{{ r.icon }}</i>
                {{#  }else{ }}
                <i class="layui-icon left-icon layui-icon-theme"></i>
                {{#  } }}
                <span>{{ r.name }}</span>
                <span class="right-icon"> <i class="layui-icon layui-icon-left"></i></span>
            </a>
            <dl class="layui-nav-child">
                {{#  layui.each(r.items, function(key,v){ }}

                    {{#  if(v.icon){ }}
                    <dd><a href="{{ v.url }}" target="main"> <i class="left-icon iconfont">&{{ v.icon }}</i> {{ v.name }}</a></dd>
                    {{#  }else{ }}
                    <dd><a href="{{ v.url }}" target="main"> <i class="layui-icon layui-icon-triangle-r"></i>{{ v.name }}</a></dd>
                    {{#  } }}

                {{#  }); }}
            </dl>
            {{#  }else{ }}
            <a href="{{ r.url }}" target="main">
                {{#  if(r.icon){ }}
                <i class="left-icon iconfont">&{{ r.icon }}</i>
                {{#  }else{ }}
                <i class="layui-icon left-icon layui-icon-theme"></i>
                {{#  } }}
                <span>{{ r.name }}</span>
                <span class="right-icon"> <i class="layui-icon layui-icon-left"></i>  <i class="layui-icon layui-icon-down"></i> </span>
            </a>
            {{#  } }}
        </li>
    {{#  }); }}
</script>
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['laytpl','layer', 'jquery','element'], function(){
        const $ = layui.jquery, layer = layui.layer;

        $('.mini-left-ck').on('click',function () {
            if($('body').hasClass('mini-left')){
                $('body').removeClass('mini-left');
            }else {
                $('body').addClass('mini-left');
            }
        });

        $('.left-nav').on('click',function(){
            $('body').removeClass('mini-left');
        });

        var tpl = left_tpl.innerHTML;
        var left_menu_json = <?php echo $left_menu_json; ?>;
        if(left_menu_json){
            layui.laytpl(tpl).render(left_menu_json, function(html){
                $('.left-nav ul').html(html);
                layui.element.init();//重新渲染 element
            });
        }
    });
</script>
</body>
</html>