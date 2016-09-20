@extends('online.main')
@section('content')
    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="frame_title">动画名称</div>
        <iframe src="{{DOMAIN}}p/lay" frameborder="0" width="720" height="438" scrolling="no" allowtransparency="true"></iframe>
    </div>

    <div class="online_list">
        <div class="listbtn"><a onclick="">更 多</a></div>
        <div class="pro_list"></div>
    </div>
@stop