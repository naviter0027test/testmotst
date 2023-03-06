<html>
    <head>
        <meta charset="utf-8">
        <title>websocket 學習 一對一</title>
        <link href='/lib/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' />
        <link href='/lib/bootstrap/dist/css/bootstrap-theme.min.css' rel='stylesheet' />
        <link href='/css/websocket/two.css' rel='stylesheet' />
    </head>
    <body>
        <div class="user-oper">
            <span class="logo">一對一</span>
            <label>使用者:</label><input type="text" name="username" />
            <button class="login">登入</button>
            <button class="logout">登出</button>
        </div>
        <div class="user-group">
            <div class="friend">梨園勝</div>
            <div class="friend">有大名</div>
        </div>
        <div class="dialog">
            <div class="message">
            </div>
            <input type="text" name="user-talk" />
            <button class="send">發送</button>
        </div>
    </body>
    <script src="/lib/jquery-2.1.4.min.js"></script>
    <script>
    var webSocket = null;
    var username = 'player-0000';
    var password = '123';
    var onSelected = [];
    var curUser;
    var friends = [];
    var groups = [];
    var host = "testmotst.axcell28.idv.tw";
    var port = 8888;

    var talkTo = '';
    $(document).ready(function() {
        $('.send').on('click', send);
    });

    function getMyselfData() {
        var cmd = {
            'cmd' : 17,
            'type' : 0,
            'userId' : username
        };
        webSocket.send(JSON.stringify(cmd));
    }

    function getFriendTalkHistory() {
        if(talkTo == '') {
            alert('對象不為空');
            return false;
        }
        var cmd = {
            'cmd' : 19,
            'type' : 1,
            'fromUserId' : talkTo,
            'userId' : username
        };
        webSocket.send(JSON.stringify(cmd));
    }

    function send() {
        if(talkTo == '') {
            alert('請選擇說話對象');
            return false;
        }
        var createTime = new Date().getTime();
        var content = $('[name=user-talk]').val();
        var cmd = {
            'cmd' : 11,
            'from' : username,
            'to' : talkTo,
            'createTime' : createTime,
            'chatType' : 2,
            'msgType' : 0,
            'content' : content
        };
        webSocket.send(JSON.stringify(cmd));
    }

    $('.login').on('click', function() {
        var userTmp = $('[name=username]').val();
        if(userTmp == '') {
            alert('請輸入使用者');
            return false;
        }
        username = 'player-' + userTmp;
        webSocket = new WebSocket("ws:"+host+":"+port+"?username="+username+"&password="+password);
        webSocket.onopen = function(e) {
            console.log('websocket on open');
            console.log(e);
            getMyselfData();
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
                //登入成功
                console.log(res.msg);
            }
            else if(res.command == 18) {
                console.log(res['data']);
                //取得自身相關、好友、群組使用者的資料
                groups = res['data']['groups'][0]['users'];
                refreshFriends();
            }
            else if(res.command == 9) {
                //他人加進群組
                groups.push(res['user']);
                refreshFriends();
            }
            else if(res.command == 10) {
                var removeId = res['data']['user']['userId'];
                //他人離開群組
                console.log(groups);
                for(var i = 0;i < groups.length;++i) {
                    if(removeId == groups[i]['userId'])
                        groups.splice(i, 1);
                }
                console.log(groups);
                refreshFriends();
            }
        };
    });
    $('.logout').on('click', function() {
        webSocket.close();
        groups = [];
    });
    function refreshFriends() {
        $('.user-group').html('');
        for(var i = 0;i < groups.length; ++i) {
            var friendId = groups[i]['userId'];
            if(friendId == username)
                continue;
            $('.user-group').append("<div class='friend'>"+friendId+"</div>");
        }
        $('.user-group .friend').on('click', function() {
            $('.user-group .friend').removeClass('clicked');
            $(this).addClass('clicked');
            console.log($(this).text());
            talkTo = $(this).text();
            //getFriendTalkHistory()
        });
    }
    </script>
</html>
