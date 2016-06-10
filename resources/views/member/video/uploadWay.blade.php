{{--关于视频上传到乐视云点播方式说明--}}


@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <style>
        .way { margin:20px 10px;width:780px;height:95%;border:1px solid lightgrey;border-radius:3px; }
        .way h3 { text-align:center; }
        .way .title,.way .intro { padding:0 20px; }
        .way .intro p { padding:0 20px; }
        .way a { color:red; }
        .way a:hover { font-weight:bold;text-decoration:underline; }
        .way .title img,.way .intro img { height:20px;cursor:pointer; }
        .bigshow { border:1px solid grey;border-radius:10px;box-shadow:0 0 20px grey;position:absolute;left:200px;top:150px;z-index:10; }
        .bigshow img { border-radius:10px; }
        .bigshow a { margin:5px 20px;padding:9px;font-size:20px;border-radius:10px;background:lightgrey;cursor:pointer;position:absolute;left:90%;top:0;z-index:10; }
        .bigshow a:hover { color:white;background:red; }
    </style>
    <div class="way">
        <h3>乐视视频上传管理方式<a style="margin:0 10px;float:right;cursor:pointer;" onclick="history.go(-1)">返 回</a></h3>

        <div class="title">一、 假如没有乐视账户，先去 <a href="http://uc.lecloud.com/registerView/registerUserView.do" target="_blank" title="点击去乐视云注册">注册</a></div>
        <div class="intro">
            <p>1> <span class="star">注册乐视账户</span>：&nbsp;&nbsp;点击上面注册，进入乐云注册页面,其中带（*）是必填，<img src="/assets-home/images/le_regist.png" title="点击看大图" id="toBigReg">。</p>
            <p>2> <span class="star">开通视频服务</span>：&nbsp;&nbsp;注册完，在右上角进入自己的账户中心，下一个页面中用户中心》我的服务，点击开通云点播功能(云点播是免费的)</p>
            <p>3> <span class="star">管理视频</span>：&nbsp;&nbsp;然后进入 <a href="http://vod.lecloud.com/Video/upload" target="_blank" title="点击进入乐视视频管理页面">视频管理</a> 页面</p>
        </div>

        <div class="title">二、 假如有乐视账户，就去 <a href="http://uc.lecloud.com/login.do" target="_blank" title="点击登录乐视云">登陆</a></div>
        <div class="intro">
            <p>1> 登陆乐视账户：&nbsp;&nbsp;点击上面登录，进入乐云登陆页面<img src="/assets-home/images/le_login.png" title="点击看大图" id="toBigLog">。</p>
            <p>2> 管理视频：&nbsp;&nbsp;登陆后，进入 <a href="http://vod.lecloud.com/Video/upload" target="_blank" title="点击进入乐视视频管理页面">视频管理</a> 页面。</p>
        </div>

        <div class="title">三、 在视频管理页面 <img src="/assets-home/images/le_video.png" title="点击看大图" id="toBigVideo"></div>
        <div class="intro">
            <p>1> 在乐视 <a href="http://vod.lecloud.com/Video/lists" target="_blank" title="乐视视频管理列表">视频列表</a> ，确保视频在启用状态，<img src="/assets-home/images/le_btn.png" title="点击看大图" id="toBigBtn">，画出来的红框按钮常用，其他按钮不用管</p>
            <p>2> 将代码按钮中的代码，复制到本站的添加或编辑的视频地址处粘贴
            <p>3> 乐视视频编辑中可选择播放前的静帧画面</p>
        </div>

        <div class="title">四、 注意别忘了将乐视的账号与密码记下，免得忘了</div>

        <h3><button class="companybtn" onclick="history.go(-1)">返 回</button></h3>
    </div>

    <div class="bigshow" style="display:none;">
        <img src="/assets-home/images/le_regist.png" id="reg" style="display:none;">
        <img src="/assets-home/images/le_login.png" id="log" style="display:none;">
        <img src="/assets-home/images/le_video.png" id="video" style="width:750px;display:none;">
        <img src="/assets-home/images/le_btn.png" id="btn" style="display:none;">
        <a id="close">X</a>
    </div>

    <script>
        $(document).ready(function(){
            $("#toBigReg").click(function(){
                $(".bigshow").show(); $("#reg").show();
            });
            $("#toBigLog").click(function(){
                $(".bigshow").show(); $("#log").show();
            });
            $("#toBigVideo").click(function(){
                $(".bigshow").show(); $("#video").show();
            });
            $("#toBigBtn").click(function(){
                $(".bigshow").show(); $("#btn").show();
            });
            $("#close").click(function(){
                $(".bigshow").hide(); $("#reg").hide(); $("#log").hide();
                $("#video").hide(); $("#btn").hide();
            });
        });
    </script>
@stop