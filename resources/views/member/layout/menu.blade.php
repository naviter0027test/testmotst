<div class="admin-menu">
    <div class="logo">
        <span>{{ config('app.name') }} -- 成員</span>
    </div>
    <div class="menu1">
        <a href="/member/home" class="{{ strpos(\Request::path(), 'member/home') === false ? '' : 'clicked' }} glyphicon glyphicon-home">
        首頁查看</a>
    </div>
    <div class="menu1">
        <a href="/member/password" class="{{ strpos(\Request::path(), 'member/password') === false ? '' : 'clicked' }} glyphicon glyphicon-star-empty">
        密碼更改</a>
    </div>
    <div class="menu1">
        <a href="/member/project/index" class="{{ strpos(\Request::path(), 'member/project') === false ? '' : 'clicked' }} glyphicon glyphicon-tasks">
        專案管理</a>
    </div>
    <div class="menu1">
        <a href="/member/logout" class="glyphicon glyphicon-share logout">
        登出</a>
    </div>
    <div class="menu1">
        <a href="https://cdpn.io/havardob/fullpage/PopKJRE" class="glyphicon glyphicon-globe" target="_blank">
        風格參考網站</a>
    </div>
</div>
