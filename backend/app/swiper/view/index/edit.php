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
    <title>{$rule['title']}</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>轮播图管理</em></div>
        <ul class="panel-tab">
            <li><a href="{:url('index')}">轮播图列表</a></li>
            <li class="layui-this"><a href="javascript:void(0);">编辑轮播图</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <!--#+++++++++++++++++++++++++++#-->
        <form class="layui-form" method="post" action="{:url('edit')}">
            <input type="hidden" name="id" value="{$id}">
            <br />
            <div class="layui-form-item">
                <label for="title" class="layui-form-label">轮播图名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" id="title" value="{$title}" class="layui-input" size="68" placeholder="请填写轮播图名称">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="status" class="layui-form-label">启用状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" id="status" value="1" title="是" {if $status == 1 }checked="checked"{/if} />
                    <input type="radio" name="status" value="0" title="否" {if $status == 0 }checked="checked"{/if} />
                </div>
            </div>

            <div class="layui-form-item">
                <label for="tab" class="layui-form-label">调用标签</label>
                <div class="layui-input-inline">
                    <input type="text" name="tab" id="tab" class="layui-input" value="{$tab}" size="68" placeholder="请填写调用标签">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="note" class="layui-form-label">轮播图说明</label>
                <div class="layui-input-inline">
                    <input type="text" name="note" id="note" class="layui-input" value="{$note}" size="68" placeholder="请填写轮播图说明">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="coordinate" class="layui-form-label">轮播图列表</label>
                <div class="layui-input-block">
                    <div>
                        <button type="button" class="layui-btn layui-btn-danger" id="add_swiper"> + 增加轮播图 </button>
                    </div>
                    <table class="layui-table">
                        <thead>
                        <tr>
                            <th width="160">名称</th>
                            <th width="80">排序</th>
                            <th>图片</th>
                            <th width="200">链接</th>
                            <th width="120">操作</th>
                        </tr>
                        </thead>
                        <tbody class="swiper-box">
                            {volist name="swiper" id="r"}
                            <tr>
                                <td><input type="text" name="swiper[name][]" value="{$r['name']}" class="layui-input" size="15" placeholder="名称"></td>
                                <td><input type="text" name="swiper[num][]" value="{$r['num']}" class="layui-input" size="15" placeholder="编号"></td>
                                <td><input type="text" name="swiper[pic][]" value="{$r['pic']}" class="layui-input swiper_pic" data-id="swiper_pic_{$i}" id="swiper_pic_{$i}" placeholder="图片"></td>
                                <td><input type="text" name="swiper[url][]" value="{$r['url']}" class="layui-input" size="10" placeholder="链接地址"></td>
                                <td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary del-swiper"> - 删除 </button></td>
                            </tr>
                            {/volist}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="layui-form-item">
                <label for="address" class="layui-form-label"></label>
                <div class="layui-input-inline">
                    <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定提交</button>
                    <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.back()">返回</button>
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
    }).use(['element','layer','jquery','form','laytpl'], function(){
        var $ = layui.jquery,
            layer  = layui.layer,
            laytpl = layui.laytpl,
            form   = layui.form;

        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('edit')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                }
            });
            return false;
        });
        upfile();
        // 添加规格
        $('#add_swiper').on('click',function(){ addAndDel(); });
        // 绑定删除
        $('.del-swiper').on('click',function(){
            $(this).parent().parent().remove();
        });
        // 添加规格输入
        function addAndDel() {
            var data = {'id': randomString(6) };
            laytpl(swiper_tpl.innerHTML).render(data, function(tpl){
                $('.swiper-box').append(tpl);
            });
            // 绑定删除
            $('.del-swiper').on('click',function(){
                $(this).parent().parent().remove();
            });
            // 绑定图片上传
            upfile();
        }

        function randomString(len) {
            len = len || 32;
            var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
            var maxPos = $chars.length;
            var str = 'd';
            for (var i = 0; i < len; i++) {
                str += $chars.charAt(Math.floor(Math.random() * maxPos));
            }
            return str;
        }

        // 图片选择
        function upfile(){
            $('.swiper_pic').unbind('click').on('click',function(){
                var id = $(this).data('id');
                layer.open({
                    type:2,
                    title:'上传图片',
                    area: ['1020px', '570px'],
                    maxmin:true,
                    content:"{:url('admin/file/api',['num'=>1])}&val="+id,
                    end:function () {}
                });
            });
        }
    });
</script>
<script id="swiper_tpl" type="text/html">
    <tr>
        <td><input type="text" name="swiper[name][]" class="layui-input" placeholder="名称"></td>
        <td><input type="text" name="swiper[num][]" class="layui-input" size="15" placeholder="编号"></td>
        <td><input type="text" name="swiper[pic][]" class="layui-input swiper_pic" data-id="{{ d.id }}" id="{{ d.id }}"  placeholder="图片"></td>
        <td><input type="text" name="swiper[url][]" class="layui-input" placeholder="链接地址"></td>
        <td><button type="button" class="layui-btn layui-btn-sm layui-btn-primary del-swiper"> - 删除 </button></td>
    </tr>
</script>
</body>
</html>