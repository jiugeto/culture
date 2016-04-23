@extends('online.main')
@section('content')
    <style>
        .img div {
            margin:0 auto;
            padding-top:10px;
            width:200px;
            height:150px;
            overflow:hidden;
        }
        .img .title { text-align:center; }
        /*动画的代码开始：定义动画时间*/
        .img {
            position:relative;
            animation-name:myfirst;
            animation-duration:5s;
            animation-timing-function:linear;
            animation-delay:2s;
            animation-iteration-count:infinite;
            animation-direction:alternate;
            animation-play-state:running;
        }
        /*动画的代码开始*/
        @keyframes myfirst
        {
            /*from {background:red;}*/
            /*to {background:yellow;}*/
            0%  {left:0px; top:0px;}
            50%  {left:200px; top:0px;}
            100%  {left:0px; top:200px;}
        }
        @-moz-keyframes myfirst /* Firefox */
        {
            /*from {background:red;}*/
            /*to {background:yellow;}*/
            0%  {left:0px; top:0px;}
            100%  {left:100px; top:0px;}
        }
        @-webkit-keyframes myfirst /* Safari and Chrome */
        {
            /*from {background:red;}*/
            /*to {background:yellow;}*/
            0%  {left:0px; top:0px;}
            100%  {left:100px; top:0px;}
        }
        @-o-keyframes myfirst /* Opera */
        {
            /*from {background:red;}*/
            /*to {background:yellow;}*/
            0%  {left:0px; top:0px;}
            100%  {left:100px; top:0px;}
        }
    </style>

    {{-- link：/assets-home/css/online.css --}}
    {{--  在线创建窗口 --}}
    <div class="online_win">
        {{--<div class="menu">菜单</div>--}}
        {{--动画模板--}}
        <div class="animate">
            <div class="img">
                <div><img src="/uploads/images/2016/ppt.png"></div>
                <div class="title">图片1</div>
            </div>
        </div>
        {{--时间线--}}
        <div class="timeline">
            <div class="start">▶</div>
            <div class="stop">■</div>
            <div class="time">
                <div></div>
            </div>
            <div class="right"><img src="/assets-home/images/voice.png"></div>
        </div>
    </div>
@stop