{{--激活QQ客服模板--}}


<style>
    .qqchat { margin:20px;padding:10px 0;width:120px;color:grey;background:rgba(200,200,200,0.5);
        position:fixed;right:0;bottom:150px; }
    .qqchat b { padding:0 10px; }
    .qqchat p { margin:0;padding:5px 0; }
    .qqchat a { padding:2px 25px;text-decoration:none;color:orangered; }
    .qqchat a:hover { color:red;background:gainsboro; }
    .qqchat .small { padding:0 10px;border-top:1px solid gainsboro;font-size:12px; }
    .qqchat p.duihua { margin-bottom:5px;color:orangered;text-align:center;border-bottom:1px solid lightgrey;
        background:lightgrey;cursor:pointer; }
    /*聊天窗口*/
    .zsp_chat { margin:0 20px;width:300px;height:300px;border:2px solid #666666;background:white;
        position:fixed;right:-350px;bottom:320px; }
    .zsp_chat p.uname { margin:0;padding:2px 10px;color:white;background:#666666; }
    .zsp_chat p.uname a { padding:0 5px;color:red;cursor:pointer;float:right; }
    .zsp_chat p.uname a:hover { background:lightgrey; }
    .zsp_chat .bottom { width:100%;background:#666666;position:absolute;bottom:0; }
    .zsp_chat .bottom a { margin-top:1px;padding:0 10px;background:lightgrey;cursor:pointer;float:right; }
    .zsp_chat .bottom a:hover { color:orangered;background:white; }
    .zsp_chat .con { padding:2px;width:296px;height:196px;overflow:auto; }
    .zsp_chat .shuru { padding:2px 5px;width:288px;height:48px;border:0;outline:none;resize:none; }
    .zsp_chat .con .left,.zsp_chat .con .right { margin-top:2px;padding:2px 5px;width:200px;color:grey;
        border:1px solid lightgrey;border-radius:3px;background:rgb(230,230,230); }
    .zsp_chat .con .left b,.zsp_chat .con .right b { color:black;font-size:12px; }
    .zsp_chat .con .left { float:left; }
    .zsp_chat .con .right { float:right; }
    .zsp_chat .con .history { padding-bottom:2px;border-bottom:1px dashed lightgrey;text-align:center;font-size:12px; }
    .zsp_chat .con .history a { color:rgb(14,144,210); }
</style>

<div class="qqchat">
    @if(isset($zspChat))
    <p class="duihua" title="点击聊天" onclick="getChat();"><b>对话</b></p>
    @endif

    <b>QQ咨询</b>
    <p><a href="http://sighttp.qq.com/msgrd?v=1&uin=2857156840" title="点击QQ咨询">
            <img src="{{PUB}}assets-home/images/qq_icon.png" width="16"> 斯塔克
        </a>
    </p>
    <p class="small">周一 -- 周六<br>09:00-18:00 在线</p>
</div>

{{--插入聊天窗口--}}
@if(isset($zspChat))
    <input type="hidden" name="chat_uid" value="0">
    <input type="hidden" name="uid" value="{{Session::has('user')?Session::get('user.uid'):0}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="zsp_chat">
        <p class="uname"><span>用户名称</span> <a>X</a></p>
        <div class="con">
            <div class="history">
                <a href="{{DOMAIN}}member/message" title="点击查看更多消息">更多消息</a>
                &nbsp;&nbsp;
                <a href="{{DOMAIN}}member/message/chat" target="_blank" title="对话窗口">单独窗口</a>
            </div>
            {{--<div class="left"><b>名称-时间：</b>00000</div>--}}
            {{--<div class="right">12345</div>--}}
        </div>
        <div style="height:1px;border-top:1px solid lightgrey;"></div>
        <textarea name="shuru" class="shuru"></textarea>
        <div class="bottom"><a onclick="sendMsg()">发送</a></div>
    </div>
    <script>
        function getChat(){
            var chat_uid = $("input[name='chat_uid']").val();
            var chat_uname = $("input[name='chat_uname_"+chat_uid+"']").val();
            var zspChat = $(".zsp_chat");
            if (chat_uid==0) {
                alert('还没有选择对话对象，去点击 对话选择 ！');return;
            }
            $("p.uname > span").html(chat_uname);
            $(".history > a").attr('href','{{DOMAIN}}member/message/chat/'+chat_uid);
            if (zspChat.css('right')=='0px') {
                zspChat.animate({'right':-350+'px'});
            } else {
                zspChat.animate({'right':0+'px'});
            }
        }

        $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
        //发送信息
        function sendMsg(){
            var chat_uid = $("input[name='chat_uid']").val();
            var uid = $("input[name='uid']").val();
            if (chat_uid==0 || uid==0) {
                alert('对话对象未定或未登录！');return;
            }
            var shuru = $("textarea[name='shuru']").val();
            if (shuru=='') {
                alert('未输入任何内容！');return;
            }
            //ajax局部刷新
            $.ajax({
                type: 'POST',
                url: '{{DOMAIN}}member/message/addmsg',
                data: {'uid':uid,'chat_uid':chat_uid,'content':shuru},
                dataType: 'json',
                success: function(data) {
                    console.log('发送成功！');
                }
            });
        }

        //自动显示信息
        window.setInterval("getChatMsg()",1000);
        function getChatMsg(){
            var chat_uid = $("input[name='chat_uid']").val();
            var uid = $("input[name='uid']").val();
            //console.log('hello');
            if ($(".zsp_chat").css('right')=='0px' && chat_uid!=0 && uid!=0) {
                //ajax局部刷新
                $.ajax({
                    type: 'POST',
                    url: '{{DOMAIN}}member/message/getmsg',
                    data: {'uid':uid,'chat_uid':chat_uid},
                    dataType: 'json',
                    success: function(data) {
//                        console.log(data.err.code);
//                        console.log(data.data.sender);
                        if (data.err.code==0) {
                            var data = data.data;
                            var left = "<div class='left'><b>对方：</b>"+data.intro+"</div>";
                            var right = "<div class='right'><b>我：</b>"+data.intro+"</div>";
                            if (data.sender==uid) {
                                $(".zsp_chat > div.con").append(right);
                            } else {
                                $(".zsp_chat > div.con").append(left);
                            }
                        }
                    }
                });
            }
        }
    </script>
@endif