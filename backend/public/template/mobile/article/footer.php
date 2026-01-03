<footer>
    <section>
        CopyRight©2021 Right Reserved<br/>
        <a href="https://beian.miit.gov.cn/" target="_blank" style="color: #666;">黔ICP备2022002481号</a>
    </section>
</footer>
<script type="text/javascript" src="{__STATIC__}extend/jquery.min.js"></script>
<script type="text/javascript" src="{__STATIC__}extend/swiper.min.js"></script>
<script type="text/javascript" src="{__STATIC__}extend/jquery.lazyload.js"></script>
<script type="text/javascript">
    $(function (){
        $(".header-bar .navSwitch").on("click", function() {
            var val = $(this).attr('class');
            if (val.indexOf('on') === -1) {
                $(this).addClass('on').parent().parent().addClass('header-fixed-bg');
                $("#nav-box").slideToggle(200);
            } else {
                $(this).removeClass('on').parent().parent().removeClass('header-fixed-bg');
                $("#nav-box").slideToggle(200);
            }
        });
        $('.bottom-btn').on('click',function (){
            var that = $(".navSwitch");
            var that_on = that.attr('class');
            if (that_on.indexOf('on') === -1) {
                that.addClass('on').parent().parent().addClass('header-fixed-bg');
                $("#nav-box").slideToggle(200);
            } else {
                that.removeClass('on').parent().parent().removeClass('header-fixed-bg');
                $("#nav-box").slideToggle(200);
            }
        });
        $(".navSearchForm").submit(function(e){
            var w = $('#w').val();
            if(!w){
                return false;
            }
            window.location.href="/search/"+w;
        });
        $(document).keyup(function(event){
            if(event.keyCode ===13){
                var w = $('#w').val();
                if(!w){
                    return false;
                }
                window.location.href="/search/"+w;
            }
        });
        $("img.lazy").lazyload({effect: "fadeIn",threshold: 100,failurelimit : 10});
    });
</script>