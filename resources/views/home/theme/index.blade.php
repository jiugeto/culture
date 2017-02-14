@extends('home.main')
@section('content')
    <div class="talk_theme">
        <div class="title">所有话题专栏 <span style="float:right;">
                @if(\Session::has('user') && !$uid)
                    <a href="{{DOMAIN}}theme/u/{{ $uid }}">我的专栏</a> &nbsp;
                @elseif(\Session::has('user') && $uid)
                    <a href="{{DOMAIN}}theme">所有专栏</a> &nbsp;
                @endif
                <a href="{{DOMAIN}}talk">话题列表</a>
            </span>
        </div>
        @if(count($datas))
            @foreach($datas as $data)
            <div class="list">
                <div class="theme">
                    <div><b>{{ $data->name }}</b></div>
                    <div class="con">{!! str_limit($data->intro,100) !!}  </div>
                    <div class="totheme">
                        @if(\Session::has('user') && $uid)<a href="{{DOMAIN}}talk/theme/{{$data->id}}">修改专栏</a>@endif
                        <a href="{{DOMAIN}}talk/theme/{{$data->id}}">进入专栏</a>
                    </div>
                    <div></div>
                </div>
            </div>
            @endforeach
        @else <div class="title">暂无专栏</div>
        @endif

        <div style="height:{{count($datas)?ceil(count($datas)/4)*350:0}}px;">{{--空白--}}</div>
        <div class="title" style="padding-top:30px;border:0;">
            <a href="{{DOMAIN}}theme/create" id="apply">专栏申请</a>
        </div>
        @include('home.common.#page')
    </div>
    <div style="height:100px;">{{--空白--}}</div>
@stop