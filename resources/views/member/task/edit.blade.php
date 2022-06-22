<html>
    <head>
        <meta charset="utf-8">
        <title>管理系統</title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/member/body.css' rel='stylesheet' />
    </head>
    <body>
@include('member.layout.menu')
        <div class="content">
            <div class="content-header">
                <span>專案管理</span> &gt; <span>專案: {{ $result['project']->title }}</span> &gt; <label>任務新增</label>
            </div>
            <form method='post' action='/member/project/task/{{ $result['projectId'] }}/edit/{{ $result['taskId'] }}' class='form1'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h5>任務名稱:</h5>
                <p>
                    <input type="text" name="name" id="name" required value="{{ $result['task']->name }}"/>
                    <label for="name" class="error col-xs-12"></label>
                </p>
                <h5>開始日期:</h5>
                <p>
                    <input type="date" name="start" id="start" required value="{{ $result['task']->start }}" />
                    <label for="start" class="error col-xs-12"></label>
                </p>
                <h5>結束日期:</h5>
                <p>
                    <input type="date" name="end" id="end" value="{{ $result['task']->end }}" />
                    <label for="end" ></label>
                </p>
                <h5>開發時數:</h5>
                <p>
                    <input type="number" name="hours" value="{{ $result['task']->hours }}" />
                </p>
                <h5>開發分鐘:</h5>
                <p>
                    <input type="number" name="minutes" value="{{ $result['task']->minutes }}" />
                </p>
                <h5>描述:</h5>
                <p>
                    <textarea name="desc">{{ $result['task']->desc }}</textarea>
                </p>
                <p class="loginBtnP"> <button class="btn">儲存</button> </p>
            </form>
        </div>
@include('member.layout.footer')
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/lib/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="/lib/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="/lib/jquery-validation/dist/localization/messages_zh_TW.min.js"></script>
    <script src="/lib/jquery.fn.gantt.js"></script>
    <script src="/js/member/logout.js"></script>
</html>
