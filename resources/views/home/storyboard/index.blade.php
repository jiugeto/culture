@extends('home.main')
@section('content')
    @include('home.common.crumb')

    {{--分镜来一个瀑布流--}}
    <link rel="stylesheet" type="text/css" href="/assets-home/css/waterfall.css">
    <div class="pbl_title">
        <a href="/storyboard" class="{{ $way=='' ? 'star' : '' }}">全部分镜</a>：
        <a href="/1/storyboard" class="{{ $way=='isnew' ? 'star' : '' }}">最新</a>
        <a href="/2/storyboard" class="{{ $way=='ishot' ? 'star' : '' }}">热门</a>
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
                        <img src="{{ $data->thumb() }}">
                    </a></div>
                <div class="title">
                    <a href="/storyboard/{{ $data->id }}" title="点击进入查看{{ $data->name }}">
                        {{ $data->limits($data->name,15) }}</a>
                </div>
                @if($data->company())<a href="">{{ $data->getComName() }}</a>@endif
                <span class="right">
                    <a class="click" onclick="like({{$data->id}})" title="点击喜欢或者不喜欢">喜欢：{{ $data->getLike() }}</a>&nbsp;&nbsp;
                    {{--<a class="click" id="apply">申请分镜</a>--}}
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
            window.location.href = "/storyboard/like/1/"+id;
        }
    </script>
@stop