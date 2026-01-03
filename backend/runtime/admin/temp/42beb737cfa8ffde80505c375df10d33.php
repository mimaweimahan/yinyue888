<?php /*a:1:{s:56:"/www/wwwroot/tisktshop.com/app/admin/view/group/auth.php";i:1661007164;}*/ ?>
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
    <title>权限设置</title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
    <style>
        html,body{background: #fff;}
        .footer-btn-fixed{
            position: fixed;
            left: 0;
            width: 100%;
            bottom: 0;
            z-index: 20;
            text-align: center;
            background: #fff;
        }
        .rule-box{ padding-bottom: 60px;}
        .footer-btn-fixed>div{ padding: 5px;}
        .layui-tree-main .layui-disabled{
            color: #333!important;
            cursor: not-allowed!important;
        }
    </style>
</head>
<body>
<div class="page-package">
    <div id="rule-box"></div>
    <div style="height:80px;"></div>
    <div class="footer-btn-fixed">
        <div>
            <button type="submit" class="layui-btn" lay-submit="getChecked">确定</button>
            <button type="button" class="layui-btn layui-btn-primary" onclick="parent.layer.closeAll()">取消</button>
        </div>
    </div>
</div>
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>
    <script type="text/javascript">
        const rule_id = "<?php echo html_entities($id); ?>";
        layui.config({
            version:1.0,
            base: '/statics/layui/modules/'
        }).use(['element','layer','jquery','util','tree'], function(){
            layui.tree.render({
                elem: '#rule-box',
                showLine: true,
                id:'rule-box-ck',
                showCheckbox:true,
                checkChild: false,
                data: <?php echo $data; ?>,
            })
            //按钮事件
            layui.util.event('lay-submit', {
                getChecked: function(){
                    var checkeds = layui.tree.getChecked('rule-box-ck'); //获取选中节点的数据
                    var ids = [];
                    for(var i=0; i < checkeds.length; i++) {
                        ids.push(checkeds[i].id);
                        if( checkeds[i].children ){
                            var child = children( checkeds[i].children );
                            if(child){
                                ids.push.apply(ids,child);
                            }
                        }
                    }
                    layui.jquery.ajax({
                        url:"<?php echo url('auth'); ?>",
                        async:false,
                        type:"POST",
                        data:{'ids':ids,'id':rule_id},
                        success: function(data){
                            layer.msg(data.msg);
                            if(data.code === 1){
                                setTimeout(function () { location.reload(); },3000);
                            }
                        }
                    });
                    return false;
                }
            });
        });
        function children(item) {
            var ids = [];
            for(var i=0; i < item.length; i++) {
                ids.push(item[i].id);
                if( item[i].children ){
                    var child = children( item[i].children );
                    if(child){
                        ids.push.apply(ids,child);
                    }
                }
            }
            return ids;
        }
    </script>
</body>
</html>
