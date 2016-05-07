@extends('online.main')
@section('content')
    {{--内页的样式方便调节动画--}}
    <style>
        .img1 div { margin:0 auto; padding-top:10px; width:960px; height:540px; overflow:hidden; }
        .img1 img { height:540px;/*border:2px solid white;*/ }
        /*================================*/
        .img2 { margin:0 auto; width:960px; height:540px; position:relative; top:-540px; }
        .img2 div.pos { padding-left:5px; width:230px; height:520px; float:left; overflow:hidden; }
        .img2 div.pos div { width:230px; height:520px; overflow:hidden; }
        .img2 div.pos img { height:520px; }
        /*================================*/
        .img3 { margin:0 auto; width:960px; height:540px; position:relative; top:-1080px; }
        .img3 div.pos { padding-left:5px; width:470px; height:520px; float:left; overflow:hidden; }
        .img3 div.pos div { width:470px; height:520px; overflow:hidden; }
        .img3 div.pos img { height:520px; }
        /*================================*/
        .img4 { margin:0 auto; width:960px; height:540px; position:relative; top:-2720px; }
        .img4 div.pos { padding:5px; width:950px; height:530px; }
        .img4 div.pos div { width:950px; height:530px; overflow:hidden; }
        .img4 div.pos img { height:540px; }
        /*================================*/
        .img5 { margin:0 auto; width:1920px; height:540px; position:relative; top:-3260px; }
        .img5 div.pos { width:1920px; height:540px; }
        .img5 div.pos div { width:960px; height:540px; float:left; overflow:hidden; }
        .img5 div.pos img { height:540px; }

        {{--动画样式--}}
        /*动画的代码开始：定义动画时间*/
        .img1 {
            position:relative; top:540px;
            opacity:1;
            animation-name:animate1;
            animation-duration:1.5s;
            animation-timing-function:ease;
            animation-delay:0s;
            /*animation-iteration-count:infinite;*/
            /*animation-direction:alternate;*/
            /*animation-play-state:running;*/
            animation-fill-mode:forwards;
        }
        .img2 .pos div {
            position:relative; left:500px; opacity:0;
            animation-name:animate2;
            animation-duration:3s;
            animation-timing-function:ease;
            animation-delay:1s;
            animation-fill-mode:forwards;
        }
        .img3 .pos div {
            position:relative; left:250px; opacity:0;
            animation-name:animate3;
            animation-duration:3s;
            animation-timing-function:ease;
            animation-delay:3s;
            animation-fill-mode:forwards;
        }
        .img4 .pos div {
            position:relative; top:0px;
            animation-name:animate4;
            animation-duration:6.5s;
            animation-timing-function:ease;
            animation-delay:5.5s;
            animation-fill-mode:forwards;
        }
        .img5 .pos div {
            position:relative; top:0px;
            animation-name:animate5;
            animation-duration:6s;
            animation-timing-function:ease;
            animation-delay:10s;
            animation-fill-mode:forwards;
        }

        /*动画的代码开始*/
        @keyframes animate1
        {
            /*from { top:600px; }*/
            /*to { top:-10px; }*/
            0% { top:600px; }
            20% { top:-10px; }
            70% { top:-10px; left:0px; opacity:1; }
            100% { top:-10px; left:-200px; opacity:0; }
        }
        @keyframes animate2
        {
            0% { left:250px; opacity:1; }
            40% { left:5px; opacity:1; }
            70% { left:5px; opacity:1; }
            100% { left:-500px; opacity:0; }
        }
        @keyframes animate3
        {
            0% { left:500px; }
            25% { left:5px; opacity:1; }
            80% { left:5px; top:0px; opacity:1; }
            100% { left:5px; top:540px; opacity:0; }
        }
        @keyframes animate4
        {
            0% { top:0px; }
            10% { top:550px; }
            40% { top:550px; }
            50% { top:1090px; }
            90% { top:1090px; opacity:1; }
            100% { top:1640px; opacity:0; }
        }
        @keyframes animate5
        {
            0% { top:0px; }
            10% { top:550px; }
            40% { top:550px; left:0px; }
            50% { top:550px; left:-960px; }
            90% { top:550px; left:-960px; opacity:1; }
            100% { top:550px; left:-960px; opacity:0; }
        }
    </style>

    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="animate" style="background:white;">
            <div class="img1">
                <div><img src="/uploads/images/2016/ppt.png"></div>
            </div>
            <div class="img2">
                <div class="pos" style="padding-left:10px;">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
                <div class="pos">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
                <div class="pos">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
                <div class="pos">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </div>
            <div class="img3">
                <div class="pos">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
                <div class="pos">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </div>
            <div class="img4">
                <div class="pos">
                    <div><img src="/uploads/images/2016/ppt.png"></div>
                </div>
            </div>
            <div class="img4">
                <div class="pos">
                    <div><img src="/uploads/images/2016/ppt.png"></div>
                </div>
            </div>
            <div class="img5">
                <div class="pos">
                    <div><img src="/uploads/images/2016/ppt.png"></div>
                    <div><img src="/uploads/images/2016/ppt.png"></div>
                </div>
            </div>
        </div>
    </div>
@stop