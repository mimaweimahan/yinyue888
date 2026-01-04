//author : ymj
var ajaxPage = {
    'box':null,
    'pageUrl':'',
    'page':0,
    'pageInput':'',
    'pageMain':'',
    'pageLoading':'',
    'pageEnd':'',
    'pageBtn':'',
    'before':'',
    'after': '',
    init: function (options) {
        if (arguments.length < 1) {
            return false;
        }
        try {
            if (typeof(options.pageBtn) == 'object') {
                this.pageBtn = options.pageBtn;
            }else{
                return false;
            }
            if (typeof options.before == 'function') {
                this.before = options.before();
            }
            if (typeof options.after == 'function') {
                this.after = options.after;
            }
        } catch (e) {
            console.log(e.name + ": " + e.message);
        }
        var $this = this;
        this.pageBtn.on('click', function (e) {
            e.preventDefault();
            var main = $(this).parent().data('main');
            if($('.'+main)){
                console.log(main);
                $this.pageMain = $('.'+main);
            }else{
                console.log('缺少分页容器');
            }
            if($(this).prev()){
                $this.pageInput = $(this).prev();
                $this.page = parseInt($this.pageInput.val());
            }
            $this.pageUrl = $(this).parent().data('url');
            if(!$this.pageUrl){
                return false;
            }
            var page   = $this.page+1;
            $this.ajaxPage(page,$this,$(this));
        });
    },
    ajaxPage(page,that,btn){
        $.ajax({
            url: that.pageUrl,
            type: 'get',
            dataType: "json",
            data: {page:page},
            beforeSend: function () {
                btn.addClass('disabled').attr('disabled', "true").text('拼命加载中..');
                if (typeof that.before == 'function') {
                    that.before();
                }
            },
            success:function(res){
                that.pageInput.val(page);
                if(res.data.current_page){
                    that.pageInput.val(res.data.current_page);
                }
                if(res.code === 1){
                    if(res.data.last_page >= page){
                        btn.removeClass('disabled').removeAttr("disabled").text('点击加载更多');
                        if (typeof that.after == 'function') {
                            that.after(that.pageMain,res.data.data);
                        }
                    }
                    if(res.data.last_page < page){
                        btn.text('已经到底了');
                        if (typeof that.after == 'function') {
                            that.after(that.pageMain,[]);
                        }
                    }
                }
                if(res.code === 0 ){
                    console.log(res);
                }

            },
            //调用出错执行的函数
            error: function () {
                alert('ajax请求目标错误！');
            }
        });
    }

};
