<html>
    <head>
        <meta charset="utf-8">
        <title>管理系統</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/lib/prettify.min.css' rel='stylesheet' />
        <link href='/css/member/body.css' rel='stylesheet' />
    </head>
    <body>
@include('member.layout.menu')
        <div class="content">
            <div class="content-header">
                <span>內容管理</span> &gt; <label>內容列表</label>
                <div class="operation-panel">
                    <a href="/member/content/create" class="btn-style1">新增</a>
                </div>
            </div>
            <table class="table1">
                <thead>
                    <tr>
                        <td>標題</td>
                        <td>建立日期</td>
                        <td>修改日期</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                @if(isset($result['contents']))
                @foreach($result['contents'] as $content)
                    <tr>
                        <td>{{ $content->title }}</td>
                        <td>{{ $content->created_at }}</td>
                        <td>{{ $content->updated_at }}</td>
                        <td>
                            <a href='/member/content/edit/{{ $content->id }}' class="glyphicon glyphicon-pencil" alt="內容編輯"></a>
                            <a href='/member/content/remove/{{ $content->id }}' class="glyphicon glyphicon-remove del" alt="內容刪除"></a>
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            <div class="pagination paginationCenter">
            @if(isset($result['amount']))
            @for($i = 0; $i < ceil($result['amount'] / $result['offset']); ++$i)
                @if(($i+1) == $result['nowPage'])
                <label>{{ $i+1 }}</label>
                @elseif(($i+1) != $result['nowPage'] && abs($i+1-$result['nowPage']) < 5)
                <a href="/member/content/?nowPage={{ $i+1 }}&{{ http_build_query($params) }}">{{ $i+1 }}</a>
                @endif
            @endfor
            @endif
            </div>
        </div>
@include('member.layout.footer')
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/js/member/logout.js"></script>
    <script src="/js/member/content/index.js"></script>
</html>
