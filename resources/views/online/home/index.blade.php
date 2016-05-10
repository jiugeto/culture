@extends('online.main')
@section('content')
    {{--内页的样式方便调节动画--}}
    <style>
        .attr_attr1 div.dh { margin:0 auto; padding-top:10px; width:960px; height:540px; overflow:hidden; }
        .attr_attr1 img { height:540px; }
        /*================================*/
        .attr_attr2 { margin:0 auto; width:960px; height:540px; position:relative; top:-540px; }
        .attr_attr2 div.pos { padding-left:5px; width:230px; height:520px; float:left; overflow:hidden; }
        .attr_attr2 div.dh { width:230px; height:520px; overflow:hidden; }
        .attr_attr2 img { height:520px; }
        /*================================*/
        .attr_attr3 { margin:0 auto; width:960px; height:540px; position:relative; top:-1080px; }
        .attr_attr3 div.pos { padding-left:5px; width:470px; height:520px; float:left; overflow:hidden; }
        .attr_attr3 div.dh { width:470px; height:520px; overflow:hidden; }
        .attr_attr3 img { height:520px; }
        /*================================*/
        .attr_attr4 { margin:0 auto; width:960px; height:540px; position:relative; top:-2720px; }
        .attr_attr4 div.pos { padding:5px; width:950px; height:530px; }
        .attr_attr4 div.dh { width:950px; height:530px; overflow:hidden; }
        .attr_attr4 img { height:540px; }
        /*================================*/
        .attr_attr5 { margin:0 auto; width:1920px; height:540px; position:relative; top:-3260px; }
        .attr_attr5 div.pos { width:1920px; height:540px; }
        .attr_attr5 div.dh { width:960px; height:540px; float:left; overflow:hidden; }
        .attr_attr5 img { height:540px; }
        /*================================*/
        .attr_attr6 { width:960px; height:540px; position:relative; top:-3260px; }
        .attr_attr6 div.dh { margin-top:240px; text-align:center; }
        /*=================时间线===============*/
        .timeline { margin-bottom:5px; width:980px; height:5px; overflow:hidden; }
        .timeline div.dh { width:980px; height:2px; background:red; }

        {{--@if(count($attrs))--}}
            {{--@foreach($attrs as $attr)--}}
                {{--{{'.'.$attr->style_name.' { margin:'.$attr->margin1.' '.$attr->margin2.'; width:'.' }'}}--}}
                {{--{{'.'.$attr->style_name}}--}}
                {{--{{'.'.$attr->style_name}}--}}
                {{--{{'.'.$attr->style_name}}--}}
            {{--@endforeach--}}
        {{--@endif--}}

        {{--动画样式--}}
        /*动画的代码开始：定义动画时间*/
        .attr_attr1 div.dh {
            position:relative; top:540px;
            opacity:1;
            animation-name:animate1;
            animation-play-state:paused;
            animation-duration:1.5s;
            animation-timing-function:ease;
            animation-delay:0s;
            /*animation-iteration-count:infinite;*/
            animation-fill-mode:forwards;
        }
        .attr_attr2 .pos div.dh {
            position:relative; left:500px; opacity:0;
            animation-name:animate2;
            animation-play-state:paused;
            animation-duration:3s;
            animation-timing-function:ease;
            animation-delay:1s;
            animation-fill-mode:forwards;
        }
        .attr_attr3 .pos div.dh {
            position:relative; left:250px; opacity:0;
            animation-name:animate3;
            animation-play-state:paused;
            animation-duration:3s;
            animation-timing-function:ease;
            animation-delay:3s;
            animation-fill-mode:forwards;
        }
        .attr_attr4 .pos div.dh {
            position:relative; top:0px;
            animation-name:animate4;
            animation-play-state:paused;
            animation-duration:6.5s;
            animation-timing-function:ease;
            animation-delay:5.5s;
            animation-fill-mode:forwards;
        }
        .attr_attr5 .pos div.dh {
            position:relative; top:0px;
            animation-name:animate5;
            animation-play-state:paused;
            animation-duration:6s;
            animation-timing-function:ease;
            animation-delay:10s;
            animation-fill-mode:forwards;
        }
        .attr_attr6 div.dh {
            font-size:12px; opacity:0;
            animation-name:end;
            animation-play-state:paused;
            animation-duration:3s;
            animation-timing-function:ease;
            animation-delay:16s;
            animation-fill-mode:forwards;
        }
        /*时间线进度条*/
        .timeline div.dh {
            position:relative; left:-980px;
            animation-name:timeline;
            animation-play-state:paused;
            animation-duration:19s;
            animation-timing-function:linear;
            animation-delay:0s;
            animation-fill-mode:forwards;
        }

        /*动画的代码开始*/
        @keyframes animate1
        {
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
        @keyframes end
        {
            0% { font-size:12px; opacity:0; }
            5% { font-size:100px; opacity:0.5; }
            15% { font-size:20px; opacity:1; }
            100% { font-size:20px; opacity:1; }
        }
        /*时间线进度条*/
        @keyframes timeline
        {
            from { left:-980px; }
            to { left:0px; }
        }
    </style>

    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="animate" style="background:white;">
            <div class="attr_attr1">
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
                </div>
            </div>
            <div class="attr_attr2">
                <div class="pos" style="padding-left:10px;">
                    <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
                </div>
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
                </div>
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
                </div>
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </div>
            <div class="attr_attr3">
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
                </div>
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </div>
            <div class="attr_attr4">
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
                </div>
            </div>
            <div class="attr_attr4">
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
                </div>
            </div>
            <div class="attr_attr5">
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
                    <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
                </div>
            </div>
            <div class="attr_attr6">
                <div class="dh">END</div>
            </div>
        </div>
    </div>
    <div class="switch">
        <div class="timeline"><div class="dh" id="timeline">{{--时间线进度条--}}</div></div>
        <a id="play"><button class="onlinebtn">播放</button></a>
        <a id="stop"><button class="onlinebtn">暂停</button></a>
    </div>

    <script>
        $(document).ready(function(){
            var dh = $(".dh");
            $("#play").click(function(){
                dh.css('animation-play-state','running');
            });
            $("#stop").click(function(){
                dh.css('animation-play-state','paused');
            });
        });
    </script>
@stop