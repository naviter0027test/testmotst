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
                <span>成員</span> &gt; <span>密碼更改</span>
            </div>
            <form method='post' action='/member/password' class='form1'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h5>請輸入舊密碼:</h5>
                <p>
                    <input type="password" name="passwordOld" id="passwordOld" required /> 
                    <label for="passwordOld" class="error col-xs-12"></label>
                </p>
                <h5>請輸入新密碼:</h5>
                <p>
                    <input type="password" name="password" id="password" required />
                    <label for="password" class="error col-xs-12"></label>
                </p>
                <h5>請輸入新密碼:</h5>
                <p>
                    <input type="password" name="passwordConfirm" id="passwordConfirm" required />
                    <label for="passwordConfirm" class="error col-xs-12"></label>
                </p>
                <p class="loginBtnP"> <button class="btn">更改</button> </p>
            </form>
        </div>
@include('member.layout.footer')
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script src="/lib/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="/lib/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="/lib/jquery-validation/dist/localization/messages_zh_TW.min.js"></script>
    <script src="/js/member/password.js"></script>
</html>
