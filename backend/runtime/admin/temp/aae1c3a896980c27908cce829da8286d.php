<?php /*a:1:{s:60:"/www/wwwroot/tisktshop.com/app/admin/view/module/modules.php";i:1660844286;}*/ ?>
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
    <title><?php echo html_entities($rule['title']); ?></title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
    <style>
        body{ overflow-x: hidden;}
        .app-main{
            display: -webkit-flex; /* Safari */
            display: flex;
            align-items:center;
            justify-content: space-between; /* 横向中间自动空间 */
            padding: 20px;
            border-radius: 3px;
            color: #666;
        }
        .app-main .icon{ width:60px; text-align: center; border-right: 1px #eee solid;}
        .app-main .icon .iconfont{ font-size:40px; color: rgba(61, 81, 89, 0.86);}
        .app-main dl{ padding-left: 15px; flex: 1;}
        .app-main dl dt{ font-weight: bold; line-height:35px; }
        .app-main ul li{ margin: 2px;}
        .app-main ul li a{ display: flex; align-items:center;}
        @media (max-width:300px){
            .app-main{flex-flow: column; text-align: center;}
            .app-main .icon{ border: 0;}
        }
        @media (max-width:600px){
            .app-list{ padding: 10px;}
        }
    </style>
</head>
<body class="body-main-p">
    <div class="app-body">
        <div class="layui-show layui-col-space15 app-list">
            <!--#+++++++++++++++++++++++++++#-->
            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?>
            <div class="layui-col-xs12 layui-col-md4 layui-col-md2">
                <div class="app-main layui-card">
                    <div class="icon">
                        <i class="iconfont"><?php if($r['icon']): ?><?php echo $r['icon']; ?>;<?php else: ?>&#xe6c5;<?php endif; ?></i>
                    </div>
                    <dl>
                        <dt><?php echo html_entities($r['module_name']); ?></dt>
                        <dd>目录：<?php echo html_entities($r['module']); ?></dd>
                        <dd>版本：<?php echo html_entities($r['version']); ?></dd>
                    </dl>
                    <ul>
                        <li>
                            <a href="<?php echo url($r['admin_url']); ?>" class="layui-btn layui-btn-sm layui-btn-primary">
                                <i class="layui-icon layui-icon-code-circle"></i>
                                <span>应用管理</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url($r['web_url']); ?>" target="_blank" class="layui-btn layui-btn-sm layui-btn-primary">
                                <i class="layui-icon layui-icon-set-sm"></i>
                                <span>应用前端</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
    <script src="/statics/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript">
        layui.config({
            version:1.0,
            base: '/statics/layui/modules/'
        }).use(['element'], function(){});
    </script>
</body>
</html>