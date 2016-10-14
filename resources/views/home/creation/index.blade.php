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
            <a href="{{DOMAIN}}creation"><div class="text {{$genre==1?'curr':''}}">☑ 已有动画
                <div class="small">已有在线模板，方便调节</div>
            </div></a>
            <a href="{{DOMAIN}}creation/s/2/0"><div class="text">□ 动画定制
                <div class="small">只有离线模板，收费预览</div>
            </div></a>
            <a href="{{DOMAIN}}creation/s/3/0"><div class="text">☒ 效果定制
                <div class="small">没有模板，用户提供效果，量身定制</div>
            </div></a>
        </div>
        <div class="cre_kong">&nbsp;</div>
        <div class="cre_cate">
            类型：
            <a href="{{DOMAIN}}creation" class="{{$cate==0?'curr':''}}">全部</a>
            @foreach($model['cates2'] as $kcate=>$vcate)
                <a href="{{DOMAIN}}creation/s/{{$kcate}}" class="{{$cate==$kcate?'curr':''}}">{{ $vcate }}</a>
            @endforeach
        </div>

        {{-- 在线片源 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="cre_source">
            <div class="title"><b>最新上线</b></div>
            <div class="source">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="{{DOMAIN}}creation/pre/{{$data->id}}" title="点击预览改作品" target="_blank">
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
            </div>
        </div>

        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        @include('home.common.page')
    </div>
@stop