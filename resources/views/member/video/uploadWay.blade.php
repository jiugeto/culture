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
    </style>
    <div class="way">
        <h3>乐视视频上传管理方法<a style="margin:0 10px;float:right;cursor:pointer;" onclick="history.go(-1)">返 回</a></h3>
        <div class="title">一、 假如没有乐视账户，先去 <a href="http://uc.lecloud.com/registerView/registerUserView.do" target="_blank">注册</a></div>
        <div class="intro">
            <p>1> 点击上面注册，进入乐云注册页面 <span class="regist"><img src=""></span>。</p>
        </div>
        <div class="title">一、 假如有乐视账户，就去 <a href="http://uc.lecloud.com/login.do" target="_blank">登陆</a></div>
        <div class="intro">
            <p>1> 点击上面注册，进入乐云登陆页面 <span class="regist"><img src=""></span>。</p>
            <p>2> 登陆后，进入视频管理页面。</p>
        </div>
        <h3><button class="companybtn" onclick="history.go(-1)">返 回</button></h3>
    </div>
@stop