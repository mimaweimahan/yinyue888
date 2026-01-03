<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <title>新增</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        .attribute-box input{ float: left; display: inline; margin-right: 5px;}
        .attribute-box span{float: left; display: inline; height: 34px; cursor: pointer; line-height: 34px; padding: 0 10px; background: #f6f6f6; border: 1px #ccc solid;}
        .attribute-box li{ clear: both ; display: block; padding: 5px 0;}
        .thumb-upload-box li{ display: inline-block; width: 120px; height: 135px;}
        .thumb-upload-box li div{ position: relative; margin: 5px;}
        .thumb-upload-box li img{ width: 100%; height: 90px;}
        .thumb-upload-box input[type=text]{ width:100%; border: 1px #eee solid; height: 25px; line-height: 25px; text-align: center; }
        .thumb-upload-box a{ padding: 5px 15px; cursor: pointer; position: absolute; top:0; left: 0; z-index: 5; background: rgba(0, 0, 0, 0.75); color: #fff;}
        .tox .tox-menubar { background:none!important;}
        .layui-form .form-label{ width: 150px}
    </style>
</head>
<body class="body-main-p">
    <div class="panel-default">
        <div class="panel-heading">
            <div class="panel-lead"><em>新增商品</em></div>
        </div>
        <div class="panel-body">
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form" method="post" action="{:url('add')}">
                <br />
                <div class="form-item">
                    <label for="title" class="form-label">商品名称：</label>
                    <div class="input-inline">
                        <input type="text" name="title" id="title" class="layui-input" size="68" placeholder="请填写商品名称">
                    </div>
                </div>
                <div class="form-item">
                    <label for="type_id" class="form-label">商品分类：</label>
                    <div class="input-select">
                        <select name="type_id" id="type_id" class="am-input-sm">
                            {$type_list|raw}
                        </select>
                    </div>
                </div>
                <div class="form-item">
                    <label for="image" class="form-label">分享图片：</label>
                    <div class="input-inline">
                        <input type="text" name="image" id="image" class="layui-input w100" placeholder="点击右侧按钮上传">
                    </div>
                    <div class="input-inline" style="width: 85px">
                        <button type="button" class="layui-btn layui-bg-green upload-btn" data-id="image"> + 点击上传 </button>
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-label" for="status">商品上下架：</label>
                    <div class="input-inline">
                        <input type="radio" name="status" value="1" title="是" checked ='checked' />
                        <input type="radio" name="status" value="0" title="否" />
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-label" for="price">价格：</label>
                    <div class="input-inline">
                        <input type="text" name="price" value="" id="price" class="layui-input" placeholder="请输入产品价格">
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-label" for="daily_sale">日销售额：</label>
                    <div class="input-inline">
                        <input type="text" name="daily_sale" value="" id="daily_sale" class="layui-input" placeholder="0">
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-label" for="total_sales">日销售额：</label>
                    <div class="input-inline">
                        <input type="text" name="total_sales" value="" id="total_sales" class="layui-input" placeholder="0">
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-label" for="incr_rate">日增长率：</label>
                    <div class="input-inline">
                        <input type="text" name="incr_rate" value="" id="incr_rate" class="layui-input" placeholder="0">
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-label" for="product_id">第三方产品ID：</label>
                    <div class="input-inline">
                        <input type="text" name="product_id" value="" id="product_id" class="layui-input" placeholder="0">
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-label" for="content">商品描述：</label>
                    <div class="input-inline">
                        <textarea name="content" id="content"></textarea>
                    </div>
                </div>
                <div class="form-item">
                    <label class="form-label"></label>
                    <div class="input-inline">
                        <button type="submit" class="layui-btn layui-btn-sm layui-btn-normal" lay-submit lay-filter="submit_btn">确定新增</button>
                        <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
                    </div>
                </div>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
    <script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
    <script type="text/javascript">
        layui.config({
            base: '{__STATIC__}layui/modules/',
            tinymce: './tinymce'
        }).use(['element','layer', 'jquery','form','laytpl','tinymce'], function(){
            var $  = layui.jquery,
                layer  = layui.layer,
                laytpl = layui.laytpl,
                form   = layui.form;
            // +++++++++++++++++++++++++
            function showImageSelector () {
                layer.open({
                    type:2,
                    title:'上传图片',
                    area: ['1020px', '570px'],
                    maxmin:true,
                    content:"{:url('admin/file/api',['num'=>15,'edit'=>1])}",
                    end:function () {}
                });
            }
            $('.upload-btn').unbind('click').on('click',function(){
                var id = $(this).data('id');
                layer.open({
                    type:2,
                    title:'上传文件',
                    area: ['1020px', '570px'],
                    maxmin:true,
                    content:"{:url('admin/file/api',['num'=>1,'type'=>'file'])}&val="+id,
                    end:function () {}
                });
            });


            layui.tinymce.render({
                elem: "#content",
                height: 600,
                width: 400,
                convert_urls: false,
                plugins: [
                    'advlist autolink lists link imageSelector hr',
                    'visualblocks visualchars code',
                    'textcolor colorpicker textpattern'
                ],
                images_upload_url: '/tool/upload/tinymce',
                imageSelectorCallback: showImageSelector,
                toolbar: 'code | styleselect | forecolor backcolor imageSelector | link bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            });

            //监听提交
            form.on('submit(submit_btn)', function (data) {
                data.field.content=layui.tinymce.get('#content').getContent();
                $.ajax({
                    url:"{:url('add')}",
                    async:false,
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

        });
    </script>
</body>
</html>