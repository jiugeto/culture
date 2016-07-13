{{-- 这里是视频预览模板 --}}


{{--@extends('layout.header')--}}
@extends('home.main')
@section('content')
    <style>
        .out { margin:0 auto;width:1000px; }
        .out p { margin:10px 0;padding:10px 0;text-align:center;border-bottom:1px solid rgba(240,240,240,1); }
        .out .video { margin:0 auto;width:{{ $video->width() }}px; }
        .out .video .userinfo { margin:15px;font-size:20px;color:rgba(220,220,220,1);position:absolute;top:20%; }
        .out .video .userinfo img { width:30px; }
    </style>
    <div class="out">
        <p>{{ $video->name }}-视频播放</p>
        <div class="video">
            <embed src="{{ $video->url }}" allowFullScreen="true" quality="high" width="{{ $video->width() }}" height="{{ $video->height }}" align="middle" allowScriptAccess="always" flashvars="{{ $video->url2 }}&auto_play={{ $video->isplay($uid) }}&width={{ $video->width() }}&height={{ $video->height() }}" type="application/x-shockwave-flash"></embed>
            <div class="userinfo"><img src="{{ $data->getComLogo() }}"> {{ $data->getUserInfo()->name }}</div>
        </div>
    </div>
@stop