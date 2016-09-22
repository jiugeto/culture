@extends('online.main')
@section('content')
    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="frame_title">动画名称</div>
        <iframe src="{{DOMAIN}}online/p/lay" frameborder="0" width="720" height="438" scrolling="no" allowtransparency="true"></iframe>
        <a href="{{DOMAIN}}online/u/product/getpro/{{$data->id}}" class="getpro">
            <div class="frame_title">获 取</div>
        </a>
    </div>
@stop