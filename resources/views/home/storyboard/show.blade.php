@extends('home.main')
@section('content')
    @include('home.common.crumb')

    {{--分镜来一个瀑布流--}}
    <link rel="stylesheet" type="text/css" href="/assets-home/css/waterfall.css">
    <div class="pbl_title pbl_show_title"><b>{{ $data->name }}</b></div>
    <div class="pbl_out">
        <div class="pbl_show_user">{{ $data->user() }} 发布于 {{ $data->created_at }}</div>
        <div class="pbl_show_con">
            <img src="{{ $data->thumb() }}">
        </div>
        <div style="height:20px;border-bottom:5px solid rgba(240,240,240,1);">{{--空白--}}</div>
        <div class="pbl_show_user">分镜简介</div>
        @if($data->intro)
        <div class="pbl_intro">{{ $data->intro }}</div>
        @else <p style="text-align:center;">无</p> @endif
    </div>
    <div class="pbl_out2">
        <div class="pbl_show_user">分镜细节</div>
        @if($data->detail && $data->getShow())
            <div class="pbl_show_con">{!! $data->detail !!}</div>
        @else <p style="text-align:center;">没有细节</p>
        @endif
    </div>
    <div class="pbl_show_btn">
        <a onclick="like({{$data->id}})" title="点击喜欢或者不喜欢">
            喜欢 <span class="star">{{ $data->getLike() }}</span>
        </a>
        <a onclick="like({{$data->id}})" title="点击申请">申请分镜</a>
    </div>
    <div style="height:50px;">{{--空白--}}</div>
    <input type="hidden" name="thumb" value="{{ $data->thumb() }}">

    <script>
        $(document).ready(function(){
            var filePath = $("input[name='thumb']").val();
            var image = new Image(); image.src = filePath;
            $(".pbl_out").css('height',image.height+400+'px');
        });

        function like(id){
            window.location.href = "/storyboard/like/2/"+id;
        }
    </script>
@stop