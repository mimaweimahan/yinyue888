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
        .color-picker-box{
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>新增单页</em></div>
    </div>
    <div class="panel-body">
        <!--#+++++++++++++++++++++++++++#-->
        <form class="layui-form" method="post" action="{:url('add')}">
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">基本信息</li>
                    <li>单页内容</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="form-item">
                            <label for="title" class="form-label">单页名称：</label>
                            <div class="input-box">
                                <input type="text" name="title" id="title" class="layui-input" size="68" placeholder="请填写活动名称">
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="label" class="form-label">唯一标识：</label>
                            <div class="input-inline">
                                <input type="text" name="label" value="" id="label" class="layui-input" size="68" placeholder="单页唯一标识">
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="padding" class="form-label">内容外边距：</label>
                            <div class="input-box">
                                <input type="text" name="padding" id="padding" value="0" class="layui-input" size="10" placeholder="内容外边距">
                                <div class="form-tips">例：选填写10px</div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="quick" class="form-label">快捷导航：</label>
                            <div class="layui-input-inline">
                                <input type="radio" name="quick" id="quick" value="1" title="开启" checked="checked" />
                                <input type="radio" name="quick" value="0" title="开启" />
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="navbar" class="form-label">顶部导航：</label>
                            <div class="layui-input-inline">
                                <input type="radio" name="navbar" id="navbar" value="1" title="开启" checked="checked" />
                                <input type="radio" name="navbar" value="0" title="关闭" />
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="navbar_bg" class="form-label">导航背景色：</label>
                            <div class="layui-input-inline" style="width: 120px;">
                                <div class="color-picker-box">
                                    <input type="text" name="navbar_bg" placeholder="请选择颜色" class="layui-input" id="navbar_bg">
                                    <div id="navbar_bg_box"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="navbar_color" class="form-label">导航字体色：</label>
                            <div class="layui-input-inline" style="width: 120px;">
                                <div class="color-picker-box">
                                    <input type="text" name="navbar_color" placeholder="请选择颜色" class="layui-input" id="navbar_color">
                                    <div id="navbar_color-box"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="footer" class="form-label">底部导航：</label>
                            <div class="layui-input-inline">
                                <input type="radio" name="footer" id="footer" value="1" title="开启" checked="checked" />
                                <input type="radio" name="footer" value="0" title="关闭" />
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="page_bg" class="form-label">页面背景色：</label>
                            <div class="layui-input-inline" style="width: 120px;">
                                <div class="color-picker-box">
                                    <input type="text" name="page_bg" placeholder="请选择颜色" class="layui-input" id="page_bg">
                                    <div id="page_bg_box"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label" for="status">是否启用：</label>
                            <div class="input-inline">
                                <input type="radio" name="status" value="1" title="是" checked="checked" />
                                <input type="radio" name="status" value="0" title="否" />
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="thumb" class="form-label">分享图片：</label>
                            <div class="input-inline">
                                <input type="text" name="thumb" id="thumb" class="layui-input w100" placeholder="点击按钮上传">
                            </div>
                            <div class="input-inline" style="width: 85px">
                                <button type="button" class="layui-btn layui-bg-green upload-btn" data-id="thumb"> + 点击上传 </button>
                            </div>
                        </div>
                    </div>
                    <!--#++++++++++++++++++#-->
                    <div class="layui-tab-item">
                        <div class="form-item">
                            <div class="input-inline">
                                <textarea name="content" id="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--#++++++++++++++++++#-->
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
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element', 'layer', 'jquery', 'form','tinymce','colorpicker'], function(){
        var $  = layui.jquery,
            layer  = layui.layer,
            form   = layui.form;
            colorpicker = layui.colorpicker;
        // +++++++++++++++++++++++++
        // 渲染
        colorpicker.render({
            elem: '#navbar_bg_box',
            color: '#1c97f5',
            done: function(color){
                $('#navbar_bg').val(color);
            }
        });

        colorpicker.render({
            elem: '#navbar_color-box',
            color: '#1c97f5',
            done: function(color){
                $('#navbar_color').val(color);
            }
        });

        colorpicker.render({
            elem: '#page_bg_box',
            color: '#1c97f5',
            done: function(color){
                $('#page_bg').val(color);
            }
        });

        function showImageSelector () {
            layer.open({
                type:2,
                title:'上传图片',
                area: ['820px', '510px'],
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
                area: ['820px', '510px'],
                maxmin:true,
                content:"{:url('admin/file/api',['num'=>1,'type'=>'file'])}&val="+id,
                end:function () {}
            });
        });
        layui.tinymce.render({
            elem: "#content",
            width: 400,
            height: 650,
            convert_urls: false,
            fontsize_formats: '12px 14px 16px 18px 24px 36px 48px 56px 72px',
            plugins: [
                'advlist autolink lists link imageSelector hr',
                'visualblocks visualchars code table',
                'textcolor colorpicker textpattern'
            ],
            images_upload_url: '/tool/upload/tinymce',
            imageSelectorCallback: showImageSelector,
            toolbar: 'code | fontsizeselect | forecolor backcolor imageSelector | link bold italic | alignleft aligncenter alignright alignjustify | blockquote | lineheight table | bullist numlist outdent indent',
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