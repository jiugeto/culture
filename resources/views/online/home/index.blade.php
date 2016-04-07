@extends('online.main')
@section('content')
    {{--  在线创建窗口 --}}
    <div class="online_win">
        {{--<div class="menu">菜单</div>--}}
        <div class="animate"></div>
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