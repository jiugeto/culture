@extends('home.main')
@section('content')
    {{--@include('home.common.crumb')--}}
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> / 在线创作
            </div>
        </div>
    </div>
    {{-- 在线作品模板 --}}
    <div class="cre_content">
        {{-- 用户类型 --}}
        {{--<div class="cre_kong">&nbsp;</div>--}}
        {{--<div class="cre_select">--}}
            {{--<button class="cre_gener">普通用户 | 免费 <img src="{{PUB}}assets-home/images/gener_x.png"></button>--}}
            {{--<button class="cre_jiantou1">=></button>--}}
            {{--<button class="cre_per">个人会员 | 免费 <img src="{{PUB}}assets-home/images/person_x.png"></button>--}}
            {{--<button class="cre_jiantou2">=></button>--}}
            {{--<button class="cre_com">企业会员 | 免费 <img src="{{PUB}}assets-home/images/company_x.png"></button>--}}
        {{--</div>--}}

        {{-- 片源类型 --}}
        <div class="cre_kong">&nbsp;</div>
        <div class="cre_cate" style="height:120px">
            <a href="{{DOMAIN}}creation">
                <div class="text {{$genre==1?'curr':''}}">☑ 已有动画
                    <div class="small">已有在线模板，方便调节</div>
                </div>
            </a>
            <a href="{{DOMAIN}}creation/s/2/0">
                <div class="text {{$genre==2?'curr':''}}">□ 动画定制
                    <div class="small">只有离线模板，收费预览</div>
                </div>
            </a>
            <a href="{{DOMAIN}}creation/s/3/0">
                <div class="text {{$genre==3?'curr':''}}">☒ 效果定制
                    <div class="small">没有模板，用户提供效果，量身定制</div>
                </div>
            </a>
        </div>
        <div class="cre_kong">&nbsp;</div>
        <div class="cre_cate">
            类型：
            <a href="
                    @if($genre!=1) {{DOMAIN}}creation/s/{{$genre}}/0
                    @else {{DOMAIN}}creation
                    @endif
                    " class="{{$cate==0?'curr':''}}">全部</a>
            @foreach($model['cates2'] as $kcate=>$vcate)
                <a href="{{DOMAIN}}creation/s/{{$genre}}/{{$kcate}}" class="{{$cate==$kcate?'curr':''}}">{{ $vcate }}</a>
            @endforeach
        </div>

        {{-- 在线片源 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="cre_source">
            <div class="title">
                <b>@if($genre==1)在线片源@elseif($genre==2)离线片源@elseif($genre==3)效果定制@endif</b>
                @if($orderPro==1)
                <a href="{{DOMAIN}}creation/s/{{$genre}}/{{$cate}}/2" class="orderPro">用户成片 ({{count($datas)}})</a>
                @else
                <a href="{{DOMAIN}}creation/s/{{$genre}}/{{$cate}}" class="orderPro">返回</a>
                @endif
            </div>
            <div class="source">
            @if($genre==3 && $orderPro==1)
                @include('home.creation.addEffect')
            @else
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="
                    @if($genre==1)
                        {{DOMAIN}}creation/pre/{{$data->id}}
                    @elseif($genre==2)
                        {{DOMAIN}}creation/edit/{{$data->id}}
                    @endif
                    " title="点击预览改作品" target="_blank">
                    <div class="cre_con">
                        <div class="img"><img src="{{ $data->getPicUrl() }}"></div>
                        <div class="text">{{ $data->name }}</div>
                    </div>
                </a>
                    @endforeach
                @endif
                @if(count($datas)<$datas->limit)
                    @for($i=0;$i<$datas->limit-count($datas);++$i)
                <div class="cre_con">
                    <div class="img">+</div>
                    <div class="text">待添加</div>
                </div>
                    @endfor
                @endif
            @endif
            </div>
        </div>

        @if($genre==3 && $orderPro==1)
        @else
            <div class="cre_kong" style="height:20px;">&nbsp;{{--10px高度留空--}}</div>
            @include('home.common.page')
        @endif
    </div>
@stop