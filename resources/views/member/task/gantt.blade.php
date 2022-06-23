<html>
    <head>
        <meta charset="utf-8">
        <title>管理系統</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/lib/prettify.min.css' rel='stylesheet' />
        <link href='/lib/jquery.gantt.css' rel='stylesheet' />
        <link href='/css/member/body.css' rel='stylesheet' />
        <link href='/css/member/home.css' rel='stylesheet' />
    </head>
    <body>
@include('member.layout.menu')
        <div class="content">
            <div class="content-header">
                <span>專案管理</span> &gt; <span>專案: {{ $result['project']->title }}</span> &gt; <label>甘特圖</label>
                <div class="operation-panel">
                    <a href="javascript:history.go(-1);" class="btn-style2">返回</a>
                </div>
            </div>
            <div class="">
                <div class="gantt">
                </div>
            </div>
        </div>
@include('member.layout.footer')
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/lib/jquery.fn.gantt.js"></script>
    <script src="/js/member/logout.js"></script>
    <script>
    $(document).ready(function() {
        $('.gantt').gantt({
            'source': "/member/project/task/{{ $result['project']->id }}/gantt/json",
            'scale': "weeks",
            'maxScale': "months",
            'minScale': "days",
            'onItemClick': function(data) {
                console.log(data);
            },
            'onAddClick': function(dt, rowId) {
                console.log(dt);
                console.log(rowId);
            },
            'onRender': function() {
                console.log("chart rendered");
            }
        });
    });
    </script>
</html>
