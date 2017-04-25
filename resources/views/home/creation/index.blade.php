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
        {{-- 在线片源 --}}
        <div class="cre_source">
            <div class="title">
                <b>{{!$isOrder?'在线片源':'用户成品'}}</b>
            </div>
            <div class="source">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="javascript:void(0);" title="点击查看">
                    <div class="cre_con">
                        <div class="img">
                            <img src="{{$data['thumb']}}" border="0">
                            <div class="dh">
                                <span onclick="getPreview({{$data['id']}});" title="点击预览">预览效果</span> &nbsp;&nbsp;
                                <span onclick="window.location.href='{{DOMAIN}}member/product/create';"
                                      title="点击去加需求">领取效果</span>
                            </div>
                        </div>
                        <div class="text">{{$isOrder?$data['pname']:$data['name']}}</div>
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
        <div style="height:20px;clear:both;">&nbsp;{{--10px高度留空--}}</div>
        @include('home.common.page2')
    </div>
    <input type="hidden" id="genre" value="{{$genre}}">
    <input type="hidden" id="isOrder" value="{{$isOrder}}">
    @include('home.common.videoPreview')

    <script>
        (function isIE() {
            var userAgent = window.navigator.userAgent; //取得浏览器的userAgent字符串
            var genre = $("#genre").val();
            var isOrder = $("#isOrder").val();
            var top;
            if (userAgent.indexOf("MSIE")>0) {
                top = -208;
            } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
                if (genre==1 && isOrder==0) {
                    top = -243;
                } else if (genre==1 && isOrder!=0) {
                    top = -200;
                }
            }
            $(".dh").css('top',top + 'px');
        })();
    </script>
@stop