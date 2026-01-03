<header class="top-header header-bg">
    <aside>
        <div class="logo-box">
            <img src="{__STATIC__}skin/logo-lv.png?v=1.1" height="40" alt="" title="" class="logo-a">
            <img src="{__STATIC__}skin/logo.png?v=1.1" height="40" alt="" title="" class="logo-b">
        </div>
        <div class="nav-search-md">
            <section>
                <a href="javascript:void(0);" class="close-search"><i class="iconfont icon-cuowu"></i></a>
                <input type="text" name="w" id="w" class="navbar-search-input" autocomplete="off" placeholder="输入关键词搜索...">
                <div class="search-btn"><button type="button" class="search-btn"><i class="iconfont icon-sousuo1"></i></button></div>
            </section>
        </div>
        <nav class="head-nav">
            <a href="/"><i class="iconfont icon-shouye"></i><span>网站首页</span></a>
            {Cms:get table="category" where="['is_menu'=>1]" order="sort asc" limit="20"}
            <a href="{$r['url']}"><i class="iconfont {$r['icon']}"></i><span>{$r['cat_name']}</span></a>
            {/Cms:get}
        </nav>
        <div class="nav-search"><button><i class="iconfont icon-sousuo1"></i></button></div>
    </aside>
</header>