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
                <span>專案管理</span> &gt; <label>專案編輯</label>
            </div>
            <form method='post' action='/member/project/edit/{{ $project->id }}' class='form1'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h5>請輸入標題:</h5>
                <p>
                <input type="text" name="title" id="title" required value="{{ $project->title }}" />
                    <label for="title" class="error col-xs-12"></label>
                </p>
                <h5>開放與否:</h5>
                <p>
                    <input type="radio" name="isPublic" id="open" value="1" {{ $project->isPublic == '1' ? 'checked' : '' }} />
                    <label for="open" >開放</label>
                    <input type="radio" name="isPublic" id="stop" value="0" {{ $project->isPublic == '0' ? 'checked' : '' }} />
                    <label for="stop" >不開放</label>
                </p>
                <h5>需求:</h5>
                <p>
                    <textarea name="requirement">{{ $project->requirement }}</textarea>
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
