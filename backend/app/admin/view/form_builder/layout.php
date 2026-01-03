<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>表单</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <script type="text/javascript" src="{__STATIC__}/loading/okLoading.js"></script>
    <style>
        .content{ padding: 10px;}
        .layui-upload-list img{height:100px;width:100px;}
        .layui-input{ width:400px;}
        .layui-textarea{ width:400px; }
        .layui-form-pane .layui-form-label{ width: 200px; text-align: left;}
        @media (max-width: 768px){
            html,body{background: #fff;}
            .layui-form-item .layui-input-inline{ margin: 0;left: 0;}
            .layui-form-pane .layui-form-label{ width: auto; border:none; padding: 0; background: none;}
            .layui-input{ width:100%;}
            .layui-textarea{ width:100%; }
            .layui-form-item .layui-input-inline{width:100%;}
        }
        .submit-btn{ width:120px;}
    </style>
</head>
<body>
<!--内容开始-->
<section class="content">
    <!--数据表开始-->
    <form class="layui-form layui-form-pane ok-form" name="form-builder" method="{$form_method}" action="{$form_url}" {$submit_confirm ?= 'submit_confirm' }>
        <!---->
        {if $form_items}
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="box box-body">
                    <!---->
                    {volist name="form_items" id="form"}
                    {switch form.type}
                    {case value="hidden"}
                    {// 隐藏域 }
                    {include file="form_builder/items/hidden" type='' /}
                    {/case}
                    {case text}
                    {// 单行文本框 }
                    {include file="form_builder/items/text" type='' /}
                    {/case}
                    {case value="textarea"}
                    {// 多行文本框 }
                    {include file="form_builder/items/textarea" type='' /}
                    {/case}
                    {case value="radio"}
                    {// 单选 }
                    {include file="form_builder/items/radio" type='' /}
                    {/case}
                    {case value="checkbox"}
                    {// 多选 }
                    {include file="form_builder/items/checkbox" type='' /}
                    {/case}

                    {case value="select"}
                    {// 下拉菜单 }
                    {include file="form_builder/items/select" type='' /}
                    {/case}

                    {default /}
                    {/switch}
                    {/volist}
                    <!---->
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            {php}if(isset($btn_hide) && !in_array('submit', $btn_hide)):{/php}
                            <button class="layui-btn submit-btn" lay-submit lay-filter="add">{$btn_title['submit']|default='提 交'}</button>
                            {php}endif;{/php}
                            {php}if(isset($btn_hide) && !in_array('back', $btn_hide)):{/php}

                            {php}endif;{/php}
                            {// 额外按钮}
                            {foreach $btn_extra as $key=>$vo }
                            {$vo|raw|default=''}
                            {/foreach}
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        {else /}
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="box box-body">
                    {$empty_tips|raw}
                </div>
                <!-- /.box -->
            </div>
        </div>
        {/if}
    </form>
</section>
<!--内容结束-->
<!--js逻辑-->
<script src="{__STATIC__}/layui/layui.js"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/lay/modules/'
    }).use(["element", "form", "laydate", "okLayer", "okUtils"],function () {
        let form = layui.form;
        let laydate = layui.laydate;
        let okLayer = layui.okLayer;
        let okUtils = layui.okUtils;

        okLoading.close();

        //laydate.render({elem: "#birthday", type: "datetime"});

        form.verify({

        });

        form.on("submit(add)", function (data) {
            okUtils.ajax("{$form_url}", "post", data.field, true).done(function (response) {
                if(response.code===1){
                    okLayer.greenTickMsg("编辑成功", function () {
                        parent.layer.close(parent.layer.getFrameIndex(window.name));
                    });
                }else{
                    okLayer.greenTickMsg(response.msg, function () {})
                }
            }).fail(function (error) {
                console.log(error)
            });
            return false;
        });
    });
</script>
</body>
</html>
