@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;background:0;">
        {{--页面顶部布局--}}
        <div class="per_top">
            <p>个人后台</p>
        </div>
        {{--页面左边布局--}}
        <div class="per_left">
            <div class="per_left1">
                <p>头像</p>
                <div class="img">
                    {{--<img src="##">--}}
                    <div style="margin:0;width:120px;height:100px;background:rgb(240,240,240);border:0;"></div>
                </div>
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
            <div class="per_right1">
                <p>好友</p>
            </div>
            <div class="per_right2">
                <p>最近访客</p>
            </div>
            <div class="per_right3">
                <p>小组</p>
            </div>
        </div>
        <div class="per_bottom"><p>底部</p></div>
    </div>
@stop