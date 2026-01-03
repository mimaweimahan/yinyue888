<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>附件管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{background:#fff; width: 100%; height: 100%;}
        .icon-img-delete {
            position: absolute;
            right: 5px;
            top: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 0 3px;
            z-index: 8
        }
        .layui-upload-img {
            width: 92px;
            height: 92px;
            margin: 0 10px 10px 0;
        }
        .fileManager li {
            width: 90px;
            height: 100px;
            overflow: hidden;
            position: relative;
            background: #f6f5f5;
            margin: 1px;
            border-radius: 3px;
        }
        .layui-elip {
            width: 100%;
            height: 22px;
            position: absolute;
            left: 0;
            bottom: 0;
            line-height: 22px;
            overflow: hidden;
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
            background: rgba(0,0,0,0.5);
            color: #fff;
        }
        .fileManager .content{
            width: 100%;
            height: 80px;
            display: flex;
            align-items: center;
        }
        .fileManager .content img{
            width: 100%;
        }
        .fileManager li::after {
            content: '';
            position: absolute;
            z-index: -1;
            width: 40px;
            height: 40px;
            right: 5px;
            bottom: 5px;
            background-image: url('/statics/success_checked.jpg');
            background-repeat: no-repeat;
        }
        .fileManager li.checked::after { z-index: 3;}
        .layui-fluid{ padding: 0; position: relative}
        .container{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-between;
        }
        .right-box{
            flex: 1;
        }
        .left-nav{
            width: 230px;
            height: calc(100% - 40px);
            position: relative;
            padding: 2vh 0;
            background: #F1F4F6;/* background: #F1F4F6; */
            overflow: hidden;
            z-index: 2;
        }
        .left-nav-top{
            width: 230px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 40px;
            left: 0;
            top: 0;
            background-color: #FFFFFF;
            position: fixed;
            z-index: 6;
        }
        #left-type-box{ z-index: 3; height: calc(100% - 40px); overflow-y: auto}
        .layui-tree{
            font-size: 12px;
        }
        #type_select{
            display: none;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-nav">
            <div class="left-nav-top">
                <a class="layui-btn layui-btn-xs layui-btn-normal" id="all_list">全部文件</a>
                <a class="layui-btn layui-btn-xs layui-btn-primary" id="set_type">分类管理</a>
            </div>
            <div style="height: 40px"></div>
            <div id="left-type-box"></div>
        </div>
        <div class="right-box">
            <button type="button" class="layui-hide" id="upload_btn"></button>
            <div class="layui-fluid">
                <div id="fileManager" lay-filter="upload"></div>
                <div style=" position: fixed; z-index: 1; top: 5px; right: 10px;">
                    <button class="layui-btn layui-btn-normal submit">确认</button>
                    <button class="layui-btn layui-btn-primary cancel">取消</button>
                </div>
            </div>
        </div>
    </div>

    <div id="type_select">
        <form class="layui-form" method="post" action="{:url('move')}">
            <input type="hidden" name="ids" id="move_ids" value="" />
            <div class="form-item">
                <label for="type_id" class="form-label">转移到</label>
                <div class="input-block">
                    <select name="type_id" id="type_id" >
                        <option value="0">跟目录</option>
                        {volist name="type_list" id="r"}
                        <option value="{$r['id']}">{$r['type_name']}</option>
                        {/volist}
                    </select>
                </div>
            </div>
            <div class="footer-btn-box">
                <div>
                    <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定转移</button>
                </div>
            </div>
        </form>
    </div>

</body>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    let type_id = parseInt("{$type_id}");
    layui.config({
        base: '{__STATIC__}/layui/extend/',
    });
    layui.extend({ 'fileManager': 'fileManager/fileManager' }).use(
        ['fileManager', 'layer', 'upload', "okUtils", "okLayer", 'tree', 'form'],
        function () {
        var fileManager = layui.fileManager
            , $ = layui.$
            , upload = layui.upload
            , layer  = layui.layer
            , form   = layui.form
            , choose = Number('{$Request.param.num}')
            , imgList = []
            , okUtils = layui.okUtils
            okLayer = layui.okLayer;
        var imgListArr = [];
        if(choose===0){
            choose = 100;
        }
        layui.tree.render({
            elem: '#left-type-box',
            showLine: true,
            id:'left-type-box-ck',
            showCheckbox:false,
            click:function(e){
                type_id = e.data.id;
                fileManager.reload('fmTest',{
                    where:{
                        'type_id': type_id,
                        'num': "{$num}",
                        'type': "{$type}",
                        'edit': "{$edit}",
                        'obj_id': "{$obj_id}",
                        'val': "{$val}",
                    }
                });
            },
            data: {$type_list_json|raw}
        })

        $('#all_list').on('click',function (){
            fileManager.reload('fmTest',{where:{'type_id': 0, page:1}});
        });

        function getType(type) {
            if (String(type).indexOf('image') !== -1) {
                return 'image';
            }
            return type;
        }

        fileManager.render({
            elem: '#fileManager'
            , method: 'post'
            , btn_upload: true
            , btn_create: false
            , btn_move: true
            , btn_del: true
            , id: 'fmTest'
            , url: "{:url('index')}"
            , where: {'type_id':type_id}
            , icon_url: '{__STATIC__}icon/'
            , thumb: { 'nopic': '{__STATIC__}null-100x100.jpg'}
            , parseData: function (res) {
                let _res = [];
                _res.code = 0;
                _res.data = [];
                for (let item of res.data) {
                    _res.data.push({
                        'thumb': item.url,
                        'path': item.url,
                        'type': getType(item.mime),
                        'name': item.name,
                        'id': item.id,
                        data: item
                    })
                }
                _res.count = res.count;
                return _res;
            }
            , page: { limit: 20 }
        });

        var upIns = upload.render({
            elem: '#upload_btn' //绑定元素
            , url: "{:url('tool/upload/file',['app'=>'file'])}"
            , multiple: true
            , accept: 'file'
            , done: function (res) {
                //上传完毕
                fileManager.reload('fmTest',{where: {'type_id':type_id}});
                imgList = [];
                imgListArr = []
            }
        });

        //监听图片上传事件
        fileManager.on('uploadfile(upload)', function (obj) {
            //更改上传组件参数
            upIns.config.data = { 'type_id': type_id };
            upIns.config.done = function (res) {
                fileManager.reload('fmTest',{where: {'type_id':type_id}});
            };
            var e = document.createEvent("MouseEvents");
            e.initEvent("click", true, true);
            document.getElementById("upload_btn").dispatchEvent(e)
        });

         //监听新建文件夹事件
        fileManager.on('new_dir(upload)', function(e){
            $.ajax({
                url:"{:url('type_add')}",
                async: false,
                type:"POST",
                data:{type_name:e.folder},
                dataType:'json',
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        location.reload();
                    }
                }
            });
        });

        //移动
        fileManager.on('move(upload)', function(e){
            var ids = [];
            for (let i=0;i<imgListArr.length;i++){
                ids.push(imgListArr[i]['id']);
            }
            $('#move_ids').val(ids.toString());
            layer.open({
                type: 1,
                area: ['350px', '400px'],
                content: $('#type_select')
            });
        });

        //提交移动
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('move')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    location.reload();
                }
            });
            return false;
        });

        //删除
        fileManager.on('del(upload)', function(e){
            var ids = [];
            for (let i=0;i<imgListArr.length;i++){
                ids.push(imgListArr[i]['id']);
            }
            layer.confirm('确认删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                okUtils.ajax("{:url('delete')}", "post", { idsStr:ids }, true).done(function (response) {
                    if (response.code === 1) {
                        okLayer.greenTickMsg(response.msg, function () {
                            //location.reload();
                            fileManager.reload('fmTest',{where: {'type_id':type_id}});
                        })
                    }
                }).fail(function (error) {
                    console.log(error)
                });
            }, function () {

            });
        });

        $('.submit').click(function () {
            <?php
            if($is_val && $edit == 0 && $type == 0){
                echo 'window.parent.run_val("'.$is_val.'",imgList[0],"'.$obj_id.'");';
            }
            if($is_fun && $edit == 0 && $type == 0){
                echo 'window.parent.run_function("'.$is_fun.'",imgList,"'.$obj_id.'");';
            }
            if($is_fun && $edit == 0 && $type == 1){
                echo 'window.parent.run_function("'.$is_fun.'",imgListArr,"'.$obj_id.'");';
            }
            ?>
            <?php if($edit == 1){ ?>
            for (let i=0;i<imgList.length;i++){
                parent.tinymce.execCommand('mceReplaceContent',false,'<img src="'+imgList[i]+'" />');
            }
            <?php } ?>
            parent.layer.close(parent.layer.getFrameIndex(window.name));
        });

        $('.cancel').on('click', function(){
            parent.layer.close(parent.layer.getFrameIndex(window.name));
        });

        $('#set_type').on('click', function(){
            parent.layer.open({
                type:2,
                title:'分类管理',
                maxmin:true,
                area: ['80vw', '90vh'],
                content:"{:url('type')}",
                end:function () {
                    location.reload();
                }
            });
        })

        fileManager.on('delete(upload)', function (obj) {
            let idsStr = obj.obj.attr('data-id');
            layer.confirm('确认删除？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                okUtils.ajax("{:url('delete')}", "post", { idsStr }, true).done(function (response) {
                    if (response.code === 1) {
                        okLayer.greenTickMsg(response.msg, function () {
                            fileManager.reload('fmTest',{where: {'type_id':type_id}});
                        })
                    }
                }).fail(function (error) {
                    console.log(error)
                });
            }, function () {

            });
        });
        //监听图片选择事件
        fileManager.on('pic(upload)', function (obj) {
            let li   = obj.obj;
            let data = obj.data.data;
            if (li.hasClass('checked')) {
                li.removeClass('checked');
                imgList.splice(data.url, 1);
                var newList = [];
                if(imgListArr.length){
                    for(var i=0; i<imgListArr.length; i++){
                        if(imgListArr[i]['id'] !== data.id ){
                            newList.push(imgListArr[i]);
                        }
                    }
                    imgListArr = newList;
                }

            } else {
                if (imgList.length === choose) {
                    return layer.msg(`只允许选择${choose}张图片`);
                }
                imgList.push(data.url);
                li.addClass('checked');
                imgListArr.push(data);
            }
        });
    });
</script>

</html>