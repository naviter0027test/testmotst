<div class="admin-bar">
    <span>{{ config('app.name') }} -- 成員</span>
    <div class="tool-right">
        <a href="/member/logout">登出</a>
    </div>
</div>

<div class="admin-menu">
    <div class="menu1">
        <a href="/member/home" class="{{ strpos(\Request::path(), 'member/home') === false ? '' : 'clicked' }} glyphicon glyphicon-home">
        首頁查看</a>
    </div>
    <div class="menu1">
        <a href="/member/setting" class="{{ strpos(\Request::path(), 'member/setting') === false ? '' : 'clicked' }} glyphicon glyphicon-star-empty">
        密碼更改</a>
    </div>
</div>
