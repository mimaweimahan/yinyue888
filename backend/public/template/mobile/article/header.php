<header>
    <div class="header-bar">
        {if $app_path == 'index/index/index'}
        <a class="goBack"></a>
        {else/}
        <a href="javascript:history.go(-1);" class="goBack"><i class="iconfont icon-jiantou2"></i></a>
        {/if}
        <aside><a href="/"><img src="/statics/skin/logo_sm.png"  height="45" /></a></aside>
        <div class="navSwitch"></div>
    </div>
    <div id="nav-box">
        <div class="nav-search">
            <form id="navSearchForm">
                <i class="iconfont icon-sousuo1"></i>
                <input type="search" class="navSearch" id="w" name="w"  placeholder="你想知道什么？">
            </form>
        </div>
        <div class="nav-bar">
            <h3>分类导航</h3>
            <ul class="nav-list">
                <li> <a href="/"><i class="iconfont icon-shouye"></i> <span>网站首页</span></a> </li>
                {Cms:get table="category" where="['is_menu'=>1]" order="sort asc" limit="20"}
                <li><a href="{$r['url']}"><i class="iconfont {$r['icon']}"></i> <span>{$r['cat_name']}</span></a></li>
                {/Cms:get}
            </ul>
        </div>
        <div class="bottom-btn">收取</div>
    </div>
</header>