@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <style>
        a.onclick { color:grey;cursor:pointer; }
        a:hover.onclick { color:red; }
    </style>

    <div class="idea_show">
        <span class="idea_left">
            <div class="idea_con">
                <p class="title">{{ $data->name }}</p>
                <p>片源类型：{{ $data->genre() }}</p>
                <p>供求类型：{{ $data->type() }}</p>
                <p>样片类别：{{ $data->cate() }}</p>
                <p>样片截图：<a href="/product/video/{{ $data->id }}/{{ $data->video_id }}">
                        <img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getPicSize($w=400,$h=150)) width:{{$size}}px; @endif height:150px;">
                    </a></p>
                <p>简介：{!! $data->intro !!}</p>
                <p>样片花絮：@if($data->getVideo1Url())<a href="{{ $data->getVideo1Url() }}">有花絮</a>@else没有花絮@endif</p>
                @if($data->money)<p>价格：{{ $data->money }}元</p>@endif
                <p>点击量：{{ $data->click }} <a class="onclick" id="addclick" title="狠狠点击">加数量</a></p>
                <p>点击用户：{{ $data->getClicks($uid) }} &nbsp;<a class="onclick" id="click" title="狠狠点击">用户点击</a></p>
                <p>喜欢用户：{{ $data->getLikes($uid) }} &nbsp;<a class="onclick" id="like" title="狠狠点击">用户喜欢</a></p>
            </div>
        </span>
        <input type="hidden" name="id" value="{{ $data->id }}">
        {{--发布方信息--}}
        <span class="idea_right">
            @if($userInfo = $data->user())
            <div class="userinfo">
                <p class="title">{{ $userInfo->company($uid) ? $userInfo->company($uid)->name.'的' : '' }} {{ $userInfo->username }}</p>
                @if($userInfo->address)<p>地址：{{ $userInfo->address }}</p>@endif
                <p>发布时间：{{ $userInfo->created_at }}</p>
            </div>
            @endif
        </span>
    </div>

    <script>
        $(document).ready(function(){
            var id = $("input[name='id']").val();
            //点击量1，点击用户2，喜欢用户3
            $("#addclick").click(function(){ window.location.href = "/product/click/"+id+'/'+1; });
            $("#click").click(function(){ window.location.href = "/product/click/"+id+'/'+2; });
            $("#like").click(function(){ window.location.href = "/product/click/"+id+'/'+3; });
        });
    </script>
@stop