<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>团队架构图</title>
    <link rel="stylesheet" href="{__STATIC__}orgtree/vue2-org-tree.css">
    <style>
        html,body{
            margin: 0;
            padding: 0;
            background: #fff;
            width: 100%;
            min-height: 100%;
        }
        .left-nav{
            position: fixed;
            left: 0;
            top: 0;
            font-size: 12px;
            padding: 10px;
            z-index: 99;
        }
        .left-nav .checkbox label{
            display: flex;
            height: 25px;
            align-items: center;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="left-nav">
        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="horizontal" /> <span>横行排列</span>
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="collapsable"/> <span>隐藏节点</span>
            </label>
        </div>
    </div>
    <div style="text-align: center">
        <vue2-org-tree
                :data="data"
                :horizontal="horizontal"
                :collapsable="collapsable"
                :label-class-name="labelClassName"
                :render-content="renderContent"
                selected-class-name="bg-tomato"
                selected-key="selectedKey"
                @on-expand="onExpand"
                @on-node-click="onNodeClick"
        />
    </div>
</div>
<script src="{__STATIC__}orgtree/vue2.5.4.min.js"></script>
<script src="{__STATIC__}orgtree/vue2-org-tree1.3.6.js"></script>
<script type="text/javascript">
    var vm = new Vue({
        el: '#app',
        data: {
            data: {$data|raw},
            expandAll: false,
            horizontal: false,
            collapsable: false
        },
        methods: {
            labelClassName: function(data) {
                return 'clickable-node'
            },
            renderContent: function(h, data) {
                return data.label
            },
            onExpand: function(e, data) {
                if ('expand' in data) {
                    data.expand = !data.expand

                    if (!data.expand && data.children) {
                        this.collapse(data.children)
                    }
                } else {
                    this.$set(data, 'expand', true)
                }
            },
            onNodeClick: function(e, data) {
                console.log('onNodeClick: %o', data)
                this.$set(data, 'selectedKey', !data.selectedKey);
                console.log();
            },
            collapse: function(list) {
                var _this = this
                list.forEach(function(child) {
                    if (child.expand) {
                        child.expand = false
                    }
                    child.children && _this.collapse(child.children)
                })
            },
            expandChange: function() {
                this.toggleExpand(this.data, this.expandAll)
            },
            toggleExpand: function(data, val) {
                var _this = this
                if (Array.isArray(data)) {
                    data.forEach(function(item){
                        _this.$set(item, 'expand', val)
                        if (item.children) {
                            _this.toggleExpand(item.children, val)
                        }
                    })
                } else {
                    this.$set(data, 'expand', val)
                    if (data.children) {
                        _this.toggleExpand(data.children, val)
                    }
                }
            }
        }
    })
</script>
</body>
</html>