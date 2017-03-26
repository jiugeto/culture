@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">皮肤设置</p>
            <div class="list" style="width:748px;height:500px">
                <div style="text-align:center;font-size:16px;"><b>顶部设置</b></div>
                <p class="user_info">顶部背景
                    {{--<a id="change_bg">更换背景</a>--}}
                </p>
                <div class="top_bg">
                    @if($spaceTopBg)<img src="{{$spaceTopBg}}">@endif
                </div>
                <div style="margin:5px 0;border-bottom:1px dashed ghostwhite;"></div>
                <p class="user_info">更换背景</p>
                <form id="sethead" method="POST" action="{{DOMAIN}}person/user/spacetopbg"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="file" name="spacetopbg" style="cursor:pointer;">
                    <input type="submit" title="点击更新图片" value="确定上传">
                </form>
                <div style="margin:20px auto;text-align:center;">
                    <button type="button" class="companybtn" onclick="history.go(-1);">返回上一页</button>
                </div>
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop