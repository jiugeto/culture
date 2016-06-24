@extends('home.main')
@section('content')
    @include('home.common.crumb')

    {{--分镜来一个瀑布流--}}
    <link rel="stylesheet" type="text/css" href="/assets-home/css/waterfall.css">
    <div class="pbl_title">全部分镜：
        <a href="">最新</a>
        <a href="">热门</a>
        <span class="right">分镜：{{ count($datas) }}</span>
    </div>
    <div class="pbl_out">
        {{--<div class="pbl_one"><div class="pbl_in">--}}
                {{--<div class="img"><a href="">--}}
                        {{--<img src="/uploads/images/2016/online1.png">--}}
                    {{--</a></div>--}}
                {{--<div class="title"><a href="">分镜名称</a></div>--}}
                {{--<a href="">公司名称</a>--}}
                {{--<span class="right">--}}
                    {{--<a class="click" title="" onclick="">喜欢：0</a>&nbsp;&nbsp;--}}
                    {{--<a class="click" onclick="">回复：0</a>--}}
                {{--</span>--}}
            {{--</div></div>--}}
        <div class="pbl_one"><div class="pbl_in">
            @if(count($datas))
            @foreach($datas as $data)
                <div class="img">
                    <a href="/storyboard/{{ $data->id }}" title="点击进入查看{{ $data->name }}">
                        <img src="{{ $data->img() }}">
                    </a></div>
                <div class="title">
                    <a href="/storyboard/{{ $data->id }}" title="点击进入查看{{ $data->name }}">
                        {{ $data->limits($data->name,15) }}</a>
                </div>
                @if($data->company())<a href="">{{ $data->getComName() }}</a>@endif
                <span class="right">
                    <a class="click" onclick="like({{$data->id}})">喜欢：0</a>&nbsp;&nbsp;
                    {{--<a class="click" onclick="reply({{$data->id}})">回复：0</a>--}}
                </span>
            @endforeach
            @else
                <div class="img"><a href="" title="">无</a></div>
                <div class="title"><a href="">分镜名称</a></div>
                <a href="">公司名称</a>
                <span class="right">
                    <a class="click" onclick="">喜欢：0</a>&nbsp;&nbsp;
                    {{--<a class="click" onclick="">回复：0</a>--}}
                </span>
            @endif
            </div></div>
    </div>
    {{--前台分页--}}
    <div class="page"></div>

    <script>
        $(document).ready(function(){
            //计算瀑布流高度
            var pbl_out = $(".pbl_out");
            var pbl_in = $(".pbl_in");
            var num = Math.ceil(pbl_in.length/4);
//            alert(Math.ceil(pbl_in.length/4));
            pbl_out.css('height',340*num+'px');
        });

        function like(id){
            window.location.href = "/storyboard/like/"+id;
        }
        function reply(id){
            window.location.href = "/storyboard/reply/"+id;
        }
    </script>
@stop