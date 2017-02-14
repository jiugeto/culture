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
        @include('home.creation.menu')
        {{-- 在线片源 --}}
        <div class="cre_source">
            <div class="title">
                <b>{{!$isOrder?'在线片源':'用户成品'}}</b>
            </div>
            <div class="source">
                @if(count($datas))
                    @foreach($datas as $kdata=>$data)
                <a href="javascript:void(0);" title="点击查看">
                    <div class="cre_con">
                        <div class="img">
                            <img src="{{ $data['thumb'] }}">
                            <div class="dh" @if($genre==1)style="top:-243px;"@endif>
                                <span onclick="getPreview({{$data['id']}});" title="点击预览">预览效果</span> &nbsp;&nbsp;
                                <span onclick="window.location.href='{{DOMAIN}}member/product/create';" title="点击去加需求">领取效果</span>
                            </div>
                        </div>
                        <div class="text">{{ $isOrder?$data['pname']:$data['name'] }}</div>
                        <input type="hidden" name="linkType{{$data['id']}}" value="{{$data['linkType']}}">
                        <input type="hidden" name="link{{$data['id']}}" value="{{$data['link']}}">
                    </div>
                </a>
                    @endforeach
                @endif
                @if(!$isOrder && count($datas)<$pagelist['limit'])
                    @for($i=0;$i<$pagelist['limit']-count($datas);++$i)
                <div class="cre_con">
                    <div class="img">+</div>
                    <div class="text">待添加</div>
                </div>
                    @endfor
                @endif
            </div>
        </div>

        <div class="cre_kong" style="height:20px;">&nbsp;{{--10px高度留空--}}</div>
        @include('home.common.page2')
    </div>

    @include('home.common.videoPreview')
@stop