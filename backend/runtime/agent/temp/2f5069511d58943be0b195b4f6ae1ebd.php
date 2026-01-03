<?php /*a:1:{s:64:"/www/wwwroot/tisktshop.com/app/agent/view/admin/wallet/index.php";i:1762764658;}*/ ?>
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
</head>
<body class="body-main-p">
<div class="page-package">
    <div class="layui-card-body">
        <div class="layui-show">
            <form class="layui-form" action="<?php echo url('add'); ?>">
                <div class="layui-form-item">
                    <label class="layui-form-label">金额变动</label>
                    <div class="layui-input-inline" style="width: 80px;">
                        <select name="money_type">
                            <option value="0">增加</option>
                            <option value="1">减少</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="money" value="" lay-verify="number" placeholder="请输入金额" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">变动原因</label>
                    <div class="layui-input-inline">
                        <input type="text" name="change_desc" value="" placeholder="请填写变动原因" class="layui-input">
                    </div>
                    <div class="layui-input-inline">
                        <input type="hidden" name="uid" value="<?php echo html_entities($uid); ?>">
                        <input type="hidden" name="acType" value="<?php echo html_entities($acType); ?>">
                        <input type="hidden" name="agent_id" value="<?php echo html_entities($agent_id); ?>">
                        <input type="hidden" name="worker_id" value="<?php echo html_entities($worker_id); ?>">
                        <input type="hidden" name="user_type" value="<?php echo html_entities($user_type); ?>">
                        <button type="button" class="layui-btn" lay-submit lay-filter="submit_btn">提交</button>
                    </div>
                </div>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="hide">
    <input type="checkbox" name="hide" value="{{d.id}}" lay-skin="switch" lay-text="隐藏|正常" lay-filter="hide" {{ d.is_hide == 1 ? 'checked' : '' }}>
</script>
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>

<script type="text/javascript">

    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,url: '<?php echo html_entities($url); ?>&acType=<?php echo html_entities($acType); ?>' //数据接口
            ,title: '数据列表'
            ,limit:"<?php echo html_entities($limit); ?>"
            ,page: true //开启分页
            ,cols: [[
                {field: 'id', hide: true},
                {field: 'created_at', title: '时间', width: 160},
                {field: "<?php echo html_entities($_field); ?>", title: '变动金额', width: 130},
                {field: "<?php echo html_entities($_current_field); ?>", title: '当前余额', width: 130},
                {field: 'is_hide',align: 'center', title: '隐藏', width: 120,toolbar: '#hide'},
                {field: 'change_desc', title: '变动原因'},
            ]]
        });

        form.on('switch(hide)', function(obj){
            var id = this.value;
            var is_hide = obj.elem.checked===true?1:0;
            $.ajax({
                url: "<?php echo url('setField'); ?>",
                type:'POST',
                data: {'val':is_hide, field:'is_hide','id': id},
                dataType:'json',
                success: function(result){
                    if (result.code) {
                        return layer.msg(result.msg);
                    }
                    table.reload('table_list',{});
                },error:function()
                {
                    layer.msg('请求失败',{time:2000,icon:2});
                }
            });
        });

        //监听提交
        form.on('submit(submit_btn)', function (data) {
            let msg = parseInt(data.field.money_type) === 0 ? "确定增加[" + data.field.uid + "]$" + data.field.money + "余额吗" : "确定减少[" + data.field.uid + "]￥" + data.field.money + "余额吗?";
            layer.confirm(msg, {
                icon: 3,
                title: "提示"
            }, function (index) {
                layer.close(index);
                let loading = layer.load();
                $.ajax({
                    url:"<?php echo url('add'); ?>",
                    data: data.field,
                    dataType: "json",
                    type: "post",
                    success: function (res) {
                        layer.close(loading);
                        if (res.code) {
                            table.reload('table_list',{});
                        }
                    }
                })
            });
            return false;
        });
    });
</script>
</body>
</html>