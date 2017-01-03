@extends('home.main')
@section('content')
    <style>
        .out { margin:0 auto;width:1000px; }
        .out p { margin:10px 0;padding:10px 0;text-align:center;border-bottom:1px solid rgba(240,240,240,1); }
        .out .video { width:{{ $video->width() }}px; }
        .out .video .userinfo { margin:15px;font-size:20px;color:rgba(220,220,220,1);position:absolute;top:20%; }
        .out .video .userinfo img { width:30px; }
        .out .download { padding:10px;text-align:center; }
        .out .download a { color:grey; }
        .out .download a:hover { color:orangered; }
        /*编辑用户修改意见*/
        .out .layer { color:grey;position:absolute;top:180px;left:{{$video->width+200}}px; }
        .out .layer textarea { border:1px solid gainsboro; }
        .out .layer select,.out .layer input { padding:2px 5px;color:grey;border:1px solid gainsboro; }
        .out .layer input { width:50px; }
        .out a { color:orangered;text-decoration:none; }
    </style>
    <div class="out">
        <p>{{ $videoName }}-视频播放</p>
        <div class="video">
            <embed src="{{ $video->url }}" allowFullScreen="true" quality="high" width="{{ $video->width() }}" height="{{ $video->height }}" align="middle" allowScriptAccess="always" flashvars="{{ $video->url2 }}&auto_play={{ isset($uid)?$video->isplay($uid):0 }}&width={{ $video->width() }}&height={{ $video->height() }}" type="application/x-shockwave-flash"></embed>
            {{--<div class="userinfo">--}}
                {{--@if(isset($data))<img src="{{ $data->getComLogo() }}"> {{ $data->getUserInfo()->name }}@endif--}}
            {{--</div>--}}
        </div>

        {{--这里用户编辑修改意见--}}
        <div class="layer">
            @if(!Session::has('user'))<p style="padding:0;border:0;color:red;">还没有登录，以下填写无效，请先登录！</p>@endif
            <form method="POST" action="{{DOMAIN}}creation/editLayer/{{$data->id}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="method" value="POST">

                修改要求：<br>
                <textarea placeholder="对动画内容、属性、动画帧的修改要求，建议格式例：01:05--图文更换/属性调整..." name="intro" cols="40" rows="10"></textarea><br>

                渲染格式：
                <select name="formatMoney">
                    @foreach($orderProModel['formatNames'] as $kformat=>$formatName)
                        <option value="{{ $orderProModel['formatMoneys'][$kformat] }}">{{ $formatName }}</option>
                    @endforeach
                </select>
                <br>
                渲染价：<span id="renderMoney" class="red">{{$orderProModel['formatMoneys'][1]}}</span>元
                <br>
                总价 = 渲染价 + 修改价

                <br>
                优先使用福利(元)：{{Session::has('user')?$wallet->weal:0}}
                <a href="{{DOMAIN}}member/wallet" target="_blank">去兑换福利</a>
                <br><br>

                <button type="submit" class="homebtn">保存修改</button>
            </form>
        </div>
        <script>
            //价格计算
            $("select[name='formatMoney']").change(function(){
                var renderMoney = $(this).val();
                $("#renderMoney").html(renderMoney);
            });
        </script>
    </div>
@stop