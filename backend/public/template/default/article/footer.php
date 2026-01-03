<footer>
    <section>
        <div class="logo"></div>
        <aside>
            <div class="footer-nav">
                {Cms:get table="category" where="['is_menu'=>1]" limit="20"}
                <a href="{$r['url']}"><span>{$r['cat_name']}</span></a>
                <span class="line">|</span>
                {/Cms:get}
                <a href="/about"><span>平台简介</span></a>
            </div>
            <p> Copyright © {:date('Y')} {:getConfig('config_app_name')} 版权所有 <a href="https://beian.miit.gov.cn/" target="_blank" style="color: #666;">黔ICP备2022002481号</a>  Powered by {:getConfig('config_app_name')} </p>
        </aside>
        <div class="contact">
            <a><i class="iconfont icon-weibo"></i></a>
            <a><i class="iconfont icon-weixin"></i></a>
        </div>
    </section>
</footer>
<div class="pageHome">
    <a href="/" class="report">
        <img src="{__STATIC__}skin/report.png" alt="">
        <div class="fix">
            <span>网上有害</span>
            <span>信息举报</span>
        </div>
    </a>
    <a class="item" href="/"><i class="iconfont icon-shuaxin"></i></a>
    <span class="item itemb" id="roll_top"><i class="iconfont icon-jiantou"></i></span>
</div>
<script type="text/javascript" src="{__STATIC__}extend/jquery.min.js"></script>
<script type="text/javascript" src="{__STATIC__}extend/anime.min.js"></script>
<script type="text/javascript" src="{__STATIC__}extend/jquery.lazyload.js"></script>
<script type="text/javascript">
    $(function (){
        $("img.lazy").lazyload({effect: "fadeIn",threshold: 100,failurelimit : 10});
        /*返回顶部*/
        var roll_top = $('#roll_top');
        roll_top.hide();
        $(window).scroll(function(){
            if($(document).scrollTop()>=100){
                roll_top.show(300);//当滑动栏向下滑动时，按钮渐现的时间
            } else {
                roll_top.hide(0);//当页面回到顶部第一屏时，按钮渐隐的时间
            }
        });
        $('.search-btn').on('click',function (){
            var w = $('#w').val();
            if(!w){
                return false;
            }
            window.location.href="/search/"+w;
        })
        roll_top.click(function () {
            $('html,body').animate({
                scrollTop : '0px'
            }, 300);
        });
        //导航上的搜索
        $('.nav-search').on('click',function (){
            $(".head-nav").hide(100);
            $(".nav-search button").hide(100);
            $(".nav-search-md").show(100);
        });
        $('.close-search').on('click',function (){
            $(".nav-search-md").hide(100);
            $(".head-nav").show(100);
            $(".nav-search button").show(100);
        });
    });
</script>