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
    </head>
    <body>
@include('member.layout.menu')
        <div class="content">
            <div class="content-header">
                <span>專案管理</span> &gt; <label>專案列表</label>
                <div class="operation-panel">
                    <a href="/member/project/create" class="btn-style1">新增</a>
                </div>
            </div>
            <table class="table1">
                <thead>
                    <tr>
                        <td>標題</td>
                        <td>是否開放</td>
                        <td>建立日期</td>
                        <td>修改日期</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                @if(isset($result['projects']))
                @foreach($result['projects'] as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->isPublicShow }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td>
                            <a href='/member/project/task/index/{{ $project->id }}' class="glyphicon glyphicon-list" alt="查看任務"></a>
                            <a href='/member/project/edit/{{ $project->id }}' class="glyphicon glyphicon-pencil" alt="專案編輯"></a>
                            <a href='/member/project/remove/{{ $project->id }}' class="glyphicon glyphicon-remove del" alt="專案刪除"></a>
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
                <a href="/member/project/?nowPage={{ $i+1 }}&{{ http_build_query($params) }}">{{ $i+1 }}</a>
                @endif
            @endfor
            @endif
            </div>
        </div>
@include('member.layout.footer')
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/lib/jquery.fn.gantt.js"></script>
    <script src="/js/member/project/index.js"></script>
    <script src="/js/member/logout.js"></script>
</html>
