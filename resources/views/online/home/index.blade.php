@extends('online.main')
@section('content')
    {{--<link rel="stylesheet" href="/assets-home/css/online.css">--}}
    @include('online.home.style')
    {{--  在线创建窗口 --}}
    <div style="height:30px;"></div>
    <div class="online_win">
        <div class="animate">
            {{--动画开始--}}
            @if(count($attrs))
            @foreach($attrs as $attr)
            <div class="{{ $attr->style_name }}">
                @if($attr->cons())
                @foreach($attr->cons() as $con)
                <div class="pos">
                    <div class="dh">
                        @if($con->genre==1)
                            <img src="{{ $conModel->getPicUrl($con->pic_id) }}">
                        @elseif($con->genre==2)
                            <div class="text">{{ $con->name }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            @endforeach
            @endif
            {{--动画结束--}}
        </div>
    </div>
    <div class="switch">
        <a id="play" title="暂停后播放"><button class="onlinebtn">播放</button></a>
        <a id="stop"><button class="onlinebtn">暂停</button></a>
        <a href="{{DOMAIN}}online/{{$data->id}}/frame" title="编辑属性、内容、动画"><button class="onlinebtn">编辑</button></a>
        <div class="timeline"><div class="dh" id="timeline">{{--时间线进度条--}}</div></div>
    </div>
    <div class="onlinelist"></div>

    <script>
        $(document).ready(function(){
            var dh = $(".dh");
            $("#play").click(function(){
                dh.css('animation-play-state','running');
            });
            $("#stop").click(function(){
                dh.css('animation-play-state','paused');
            });
        });
    </script>
@stop