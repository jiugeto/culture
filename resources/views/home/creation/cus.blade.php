@extends('home.main')
@section('content')
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
        {{-- 定制片源 --}}
        <div class="cre_source">
            <div class="title">
                <b>@if($isOrder)用户成品
                    @elseif(!$isOrder&&$genre==2)离线片源
                    @elseif(!$isOrder&&$genre==3)效果定制
                    @endif</b>
            </div>
            <div class="source">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="javascript:void(0);">
                    <div class="cre_con">
                        <div class="img">
                            <img src="{{ $data['thumb'] }}">
                            <div class="dh">
                                <span onclick="getPreview({{$data['id']}});" title="点击预览">看动画</span> &nbsp;&nbsp;
                                <span onclick="window.location.href='{{DOMAIN}}member/online';" title="点击去加需求">加需求</span>
                            </div>
                        </div>
                        <div class="text">
                            <span title="点击预览" onclick="getPreview({{$data['id']}});">{{ $data['name'] }}</span>
                            {{--@if(!$isOrder)<span onclick="alert('00');return;" style="float:right;">去添加</span>@endif--}}
                        </div>
                        <input type="hidden" name="linkType{{$data['id']}}" value="{{$data['linkType']}}">
                        <input type="hidden" name="link{{$data['id']}}" value="{{$data['link']}}">
                    </div>
                </a>
                    @endforeach
                @endif
                @if(count($datas)<$pagelist['limit'])
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

        @include('home.common.videoPreview')
    </div>
@stop