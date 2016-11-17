<!DOCTYPE html>
<html>
<head>
    <title>做视频</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{PUB}}assets/images/icon.png">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/home.css">
    <link rel="stylesheet" type="text/css" href="{{PUB}}assets-home/css/member.css">
    <script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
    <style>
        .mem_con { width:1000px; }
        .mem_con .crumb { margin:2px 0;padding:2px 0;width:995px;height:20px;color:rgb(14,144,210);font-size:14px; }
        .mem_con .crumb #right { float:right; }
        .mem_con .chat { color:grey;float:left; }
        .chat_left { width:150px;height:552px;border:1px solid lightgrey;background:lightgrey; }
        .chat_left .frield { margin:5px;margin-bottom:0;padding:5px;width:128px;height:25px;border:1px solid #e6e6e6;
            background:#e1e1e1;cursor:pointer; }
        .chat_left #ffirst { border:1px solid #fafafa;background:#f5f5f5; }
        .chat_left div:hover.frield,.chat_left div:hover#ffirst { border:1px solid pink;background:white; }
        .chat_left .frield div { float:left; }
        .chat_left .frield .img { margin-right:10px;width:25px;height:25px;border-radius:3px;background:white;overflow:hidden; }
        .chat_left .frield .img img {  }
        .chat_left .frield .cname { line-height:25px; }
        .chat_right { width:845px;border:1px solid #f0f0f0; }
        #chat_top { height:50px;border-left:0;border-bottom:0;background:#f5f5f5; }
        #chat_top .cname { padding:10px 20px;color:black; }
        #chat_middle { height:380px;border-left:0;border-bottom:0;overflow:auto; }
        #chat_middle .left,#chat_middle .right { margin:10px 0;width:600px; }
        #chat_middle .left,#chat_middle .chat_name,#chat_middle .con { float:left; }
        #chat_middle .right { float:right; }
        #chat_middle .con { padding:5px 10px;width:520px;border:1px solid lightgrey;border-radius:3px;background:#fafafa;
            /*自动换行*/
            word-wrap:break-word;word-break:break-all; }
        #chat_middle .right .con { width:540px; }
        #chat_middle b { margin:0 10px; }
        #chat_bottom { width:845px;height:120px;border-left:0; }
        #gongju,#shuru { width:740px;float:left; }
        #gongju { border-bottom:1px dashed #f0f0f0; }
        #gongju .gj { padding:2px 10px;border-right:1px solid #f0f0f0;float:left;cursor:pointer; }
        #gongju div:hover.gj { color:white;background:#bbbbbb; }
        #emoticon { width:520px;height:100px;/*background:#f0f0f0;*/position:absolute;display:none; }
        #emoticon .fang { width:24px;height:24px;border:1px solid lightgrey;background:white;float:left; }
        #emoticon div:hover.fang { border:1px solid orangered; }
        #emoticon .close { width:485px;height:25px;text-align:center;color:orangered;background:#f0f0f0;float:right;cursor:pointer; }
        #send { width:100px;height:120px;text-align:center;line-height:120px;color:white;
            background:indianred;float:right;cursor:pointer; }
        div:hover#send { background:orangered; }
        #shuru { height:90px; }
        #shuru div#input { padding:5px 10px;height:80px;outline:none; }
    </style>
</head>
<body>
@include('layout.header')
@include('layout.navigate')
<div class="mem_con">
    <div class="crumb"><span id="right"><a href="/">首页</a> > 即时窗口</span></div>
    {{--左边的行业列表--}}
    <div class="chat chat_left">
        @if($chat)
        <div class="frield" id="ffirst">
            <div class="img">
                <img src="@if($chat->head()){{$chat->head()}}@else{{PUB.'assets/images/icon.png'}}@endif" width="25">
            </div>
            <div class="cname">{{str_limit($chat->username,10)}}</div>
        </div>
        <div style="margin:5px 0;height:1px;border-bottom:1px dashed #e6e6e6;"></div>
        @endif
        @if(count($frields))
            @foreach($frields as $frield)
        <div class="frield">
            <div class="img">
                <img src="@if($frield->getHeadUrl()){{$frield->getHeadUrl()}}@else{{PUB.'assets/images/icon.png'}}@endif" width="25">
            </div>
            <div class="cname">{{str_limit($frield->getFrieldName(),10)}}
                <span style="color:white;">{{in_array($chat->id,[$frield->uid,$frield->frield_id])?'√':''}}</span>
            </div>
        </div>
            @endforeach
        @endif
    </div>
    {{--右侧上面--}}
    <div class="chat chat_right" id="chat_top">
        <div class="cname"><b>{{$chat->username}}</b></div>
    </div>
    {{--右侧信息显示列表--}}
    <div class="chat chat_right" id="chat_middle">
        {{--{{dd(unserialize(Redis::get('chatList')))}}--}}
        {{--历史记录展示--}}
        @if(Redis::exists('chatList') && Session::has('user'))
            @foreach(unserialize(Redis::get('chatList')) as $chatList)
                @if($chatList['accept']==Session::get('user.uid'))
                    <div class="left">
                        <div class="chat_name"><b>对方</b></div>
                        <div class="con">{!! $chatList['intro'] !!}</div>
                    </div>
                @else
                    <div class="right">
                        <div class="con">{!! $chatList['intro'] !!}</div>
                        <div class="chat_name"><b>我</b></div>
                    </div>
                @endif
            @endforeach
        @endif
        {{--<div class="left">
            <div class="chat_name"><b>对方</b></div>
            <div class="con">12345123451234512345123451234512345123451234512345</div>
        </div>
        <div class="right">
            <div class="con">54321</div>
            <div class="chat_name"><b>我</b></div>
        </div>--}}
    </div>
    {{--右侧发送--}}
    <div class="chat chat_right" id="chat_bottom">
        <div id="gongju">
            {{--<div class="gj">文字</div>--}}
            <div class="gj" title="点击选择表情" onclick="$('#emoticon').show();">☺</div>
            {{--<div class="gj">图片</div>--}}
            <div id="emoticon">
                <div style="height:25px;">
                    <div class="close" title="关闭表情包" onclick="$('#emoticon').hide();">X</div>
                </div>
                @for($i=1;$i<81;++$i)
                <div class="fang" id="bq_{{$i}}" onclick="setEmoticon({{$i}});">
                    <img src="@if($i<64){{PUB}}assets-home/emoticons/bq_{{$i}}.{{$i<8?'gif':'png'}}@endif">
                </div>
                @endfor
            </div>
        </div>
        <div id="send" onclick="send();">发 送</div>
        <div id="shuru">
            <div id="input" onkeyup="document.selection.createRange()"  contenteditable="true"></div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="sender" value="{{Session::has('user')?Session::get('user.uid'):0}}">
    <input type="hidden" name="accept" value="{{$chat->id}}">
</div>
@include('layout.footer')
</body>
</html>

<script>
    $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
    var chat_uid = $("input[name='accept']").val();
    var uid = $("input[name='sender']").val();
    //区域显示记录
    window.setInterval('getChatMsg()',1000);
    function getChatMsg(){
        $.ajax({
            type: 'POST',
            url: '{{DOMAIN}}member/message/getmsg',
            data: {'uid':uid,'chat_uid':chat_uid},
            dataType: 'json',
            success: function(data) {
                console.log(data.data);
                if (data.err.code==0) {
                    var msg = data.data;
                    var left ='<div class="left">';
                    left +='<div class="chat_name"><b>对方</b></div>';
                    left +='<div class="con">'+msg.intro+'</div>';
                    left +='</div>';
                    var right ='<div class="right">';
                    right +='<div class="con">'+msg.intro+'</div>';
                    right +='<div class="chat_name"><b>我</b></div>';
                    right +='</div>';
                    if (msg.sender==uid) {
                        $("#chat_middle").append(right);
                    } else {
                        $("#chat_middle").append(left);
                    }
                }
            }
        });
    }
    //表情包
    function setEmoticon(i){
        var bq = $("#bq_"+i).html();
        $("#input").append(bq);
        $("#emoticon").hide();
    }
    //enter键控输入
    $("#chat_bottom").keypress(function(e){
        if (13 == event.keyCode) {
//            alert("响应键盘的enter事件");
            send();
        }
    });
    //提交输入的内容
    function send(){
        var content = $("#input").html();
        if (chat_uid==0 || uid==0) {
            alert('对话对象未定或未登录！');return;
        }
        if (content=='') {
            alert('未输入任何内容！');return;
        } else if (content.length>2900){
            alert('输入内容过多！');return;
        }
//        alert(content);return;
        $.ajax({
            type: 'POST',
            url: '{{DOMAIN}}member/message/addmsg',
            data: {'uid':uid,'chat_uid':chat_uid,'content':content},
            dataType: 'json',
            success: function(data) {
                console.log('发送成功！');
                $("#input").html('');
            }
        });
    }
</script>