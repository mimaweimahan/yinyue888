(function (global, factory) { typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :  typeof define === 'function' && define.amd ? define(['exports'], factory) :  window.layui && layui.define ? layui.define(function(exports){exports('smsSend',factory(exports))}) : (factory((global.smsSend = {})));
}(this, (function (exports) { 'use strict';
    const $ = window.layui.jquery;
    return  {
    'smsApi': '/member/login/sms_verification', //默认发送短信的地址
    'smsBox': '',//默认容器
    'timing': 60,//默认等待60秒
    'mobile': '',//手机号码对象
    'verify': '',//默认验证码对象
    'instructions':' ',//验证码前的说明文字：
    'button': '',
    'before': '', //@ param options.before  function 发送短信前执行的函数
    'after': '',  //@ param options.after  function 发送短信后返回执行的函数
    'verifyFunc': '', //@ param options.verifyFunc  function 验证码为空，或错误时执行的函数
    /**
     * @ param options  object 参数
     options = {
		   'smsApi':'/tool/sms/', //发送短信的地址
		   'smsBox':$('#smsBox'),
		   'timing':60,
		   'mobile':$('#mobile'),
		   'verify':$('#vcode'),
		   'verifyFunc':function(){},
		   'before':function(){},
		   'after':function(){}
		};
     */
    init: function (options) {
        if (arguments.length < 1) {
            return false;
        }

        try {
            if (options.smsApi) {
                this.smsApi = options.smsApi;
            }

            if (typeof(options.box) !== 'object') {
                return false;
            }
            //执行before function
            if (typeof options.before == 'function') {
                this.before = options.before();
            }

            if (typeof options.after == 'function') {
                this.after = options.after;
            }

            if (typeof(options.button) == 'object') {
                this.button = options.button;
            } else {
                this.button = options.box.find("#smsSendBtn");
            }
            if (options.timing > 0) {
                this.timing = options.timing;
            }
            if (options.instructions) {
                this.instructions = options.instructions;
            }
        } catch (e) {
            console.log(e.name + ": " + e.message);
        }

        if (!this.button) {
            console.log('缺少按钮对象！');
            return false;
        }

        var $this = this;

        this.button.on('click', function (e) {
            e.preventDefault();
            //判断手机号
            if (typeof options.mobile == 'object') {
                $this.mobile = options.mobile;
            } else {
                $this.mobile = options.box.find('#mobile');
            }

            if (!$this.mobile.val()) {
                layer.msg('请填手机号或邮箱');
                return false;
            }
            //验证有效手机号码
            if (!$this.mobile.val().match(/^(13[0-9]|14[5-9]|15[012356789]|166|17[0-8]|18[0-9]|19[8-9])[0-9]{8}$/) && !$this.mobile.val().match(/^([a-zA-Z0-9._-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/) ) {
                layer.msg('请填正确的手机号');
                return false;
            }
            //判断验证码
            if (typeof options.verify == 'object') {
                $this.verify = options.verify;
            }
            if (!$this.verify.val()) {
                //如果存在 执行验证码函数
                console.log(typeof options.verifyFunc);
                if (typeof options.verifyFunc == 'function') {
                    $this.verifyFunc = options.verifyFunc;
                    $this.verifyFunc();
                } else {
                    layer.msg('请填写验证码');
                }
                return false;
            }
            //点击是判断是否已处于计时状态
            if ($(this).hasClass('disabled')) {
                return false;
            } else {
                //执行发送短信函数！
                $this.sendSms();
            }

        });

    },
    /**
     * 改变发按钮的状态及式样
     */
    countdown: function () {
        var $this = this;
        var a = this.timing + 1;
        var i = this.getCookie('countdown' + $this.mobile.val());

        if (i > 0) {
            a = i;
        }
        return function () {
            if (a > 0) {
                a--;
            }
            //把值写cookie 避免刷新后数据丢失 同时保存手机号到cookie
            $this.setCookie('countdown' + $this.mobile.val(), a, $this.timing * 1000);
            return a;
        };
        ///解除引用来避免内存泄漏
        a = null;
    },
    //执行倒计时函数,改变按钮状态
    setBtnTime: function () {
        var $this = this;

        var $time = this.countdown($this.mobile.val());

        var i = window.setInterval(function () {

            var t = $time();
            $this.button.addClass('disabled').attr('disabled', "true").html('等待(' + t + ')秒');//添加disabled属性
            if (t === 0) {
                $this.verify.val(' ');
                $this.button.removeClass('disabled').removeAttr("disabled").html('重新获取'); //移除disabled属性
                //当计时为0 时 移除计时函数；
                window.clearInterval(i);
            }

        }, 1000);

    },
    /**
     * 写 cookies
     * @ param  name str cookie名称
     * @ param  value  cookie 值
     * @ param  time  int 保存时间（毫秒单位）
     */
    setCookie: function (name, value, time) {
        var exp = new Date();
        exp.setTime(exp.getTime() + time);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
    },
    /**
     * 读取 cookies
     * param  name  cookie名称
     */
    getCookie: function (name) {
        let reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        let arr  = document.cookie.match(reg);
        if (arr) {
            return unescape(arr[2]);
        } else {
            return null;
        }
    },
    /**
     * 发送短信
     * @ param options  obj
     */
    sendSms: function () {
        /*测试
         +++++++++++++++++++++++
         //开始执行计算器函数
         this.setBtnTime();
         //执行后置函数
         if(typeof this.after == 'function'){
         this.after();
         }
         end 测试
         */
        //+++++++++++++++++++++++++++++
        //开始提交短信发送
        var $this = this;
        $.ajax({
            type: 'POST',
            url: $this.smsApi,
            data: {'mobile': $this.mobile.val(), 'code': $this.verify.val(),'instructions':$this.instructions},
            dataType: "json",
            beforeSend: function () {
                //提交前执行
                $this.button.text('短信发送中...');
            },
            success: function (data) {
                $this.button.text('获取验证码');
                if (data['code'] == '1') {
                    layer.msg(data['msg']);
                    //短信发送成功后开始倒计时！
                    $this.setBtnTime();
                    //执行after
                    if (typeof $this.after == 'function') {
                        $this.after();
                    }
                }else{
                    layer.msg(data['msg']);
                    if(data['data'] == '1001' && typeof $this.verifyFunc == 'function'){
                        $this.verifyFunc();
                    }
                }
                return false;

            },
            //调用出错执行的函数
            error: function () {
                layer.msg('ajax请求目标错误');
            }
        });
        }
    };
})));