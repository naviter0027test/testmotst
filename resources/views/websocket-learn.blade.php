<html>
    <head>
        <meta charset="utf-8">
        <title>websocket 學習</title>
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
    </head>
    <body>
        <p>
            <button id="login">登入</button>
            <button id="logout">登出</button>
            <button id="getMySelf">取得登入者的訊息</button>
        </p>
        <div id="log">
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script>
    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }
    var webSocket = null;
    var username = 'user'+getRandomInt(99999);
    var password = '123';
    var onSelected = [];
    var curUser;
    var friends = [];
    var groups = [];
    var host = "testmotst.axcell28.idv.tw";
    var port = 8888;
    $(document).ready(function() {
    });
    $('#login').on('click', function() {
        webSocket = new WebSocket("ws:"+host+":"+port+"?username="+username+"&password="+password);
        webSocket.onopen = function(e) {
            console.log('websocket on open');
            console.log(e);
        };
        webSocket.onerror = function(e) {
            console.log('error:');
            console.log(e);
        };
        webSocket.onclose = function(e) {
            console.log('end');
        };
        webSocket.onmessage = function(e) {
            console.log(e);
            var res = JSON.parse(e.data);
            console.log('接收結果');
            console.log(res);
            if(res.command == 6) {
                console.log(res.msg);
            }
            else if(res.command == 18) {
                console.log('取得自身相關資訊');
            }
        };
    });
    $('#logout').on('click', function() {
        webSocket.close();
    });

    $('#getMySelf').on('click', function() {
        var cmd = {
            'cmd' : 17,
            'type' : 0,
            'userId' : username
        };
        webSocket.send(JSON.stringify(cmd));
    });
    </script>
</html>
