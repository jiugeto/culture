@extends('person.main')
@section('content')
    <div class="per_body">
        {{--页面顶部布局--}}
        <div class="per_top">
            <p>个人后台</p>
        </div>
        {{--页面左边布局--}}
        <div class="per_left">
            <div class="per_left1">
                <p>头像</p>
                <div><img src="##"></div>
            </div>
            <div class="per_left2">
                <p>统计信息</p>
            </div>
            <div class="per_left3">
                <p>相册</p>
            </div>
        </div>
        {{--页面中间布局--}}
        <div class="per_center">
            <div class="per_center1">
                <p>资料</p>
            </div>
            <div class="per_center2">
                <p>动态</p>
            </div>
            <div class="per_center3">
                <p>留言板</p>
            </div>
        </div>
        {{--页面右侧布局--}}
        <div class="per_right">
            <div class="per_right1">好友</div>
            <div class="per_right2">最近访客</div>
            <div class="per_right3">小组</div>
        </div>
    </div>
@stop