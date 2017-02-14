@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            分类：
            <select name="cate" class="home_search">
                <option value="0" {{ $cate==0 ? 'selected' : '' }}>所有</option>
                @foreach($model['cates'] as $kcate=>$vcate)
                    <option value="{{ $kcate }}" {{ $cate==$kcate ? 'selected' : '' }}>{{ $vcate }}</option>
                @endforeach
            </select>
        </div>
        <script>
            $("select[name='cate']").change(function(){
                var cate = $(this).val();
                if (cate==0) {
                    window.location.href = '{{DOMAIN}}design';
                } else {
                    window.location.href = '{{DOMAIN}}design/cate/'+cate;
                }
            });
        </script>

        {{-- 列表 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        {{--面包屑--}}
        {{--<div class="de_title">3D设计 > C4D</div>--}}
        {{--设计列表--}}
        <div class="de_list">
            <table class="record">
            @if(count($datas))
                @foreach($datas as $data)
                    <tr>
                        <td rowspan="3">
                            <a href="{{DOMAIN}}design/{{ $data['id'] }}" title="{{ $data['name'] }}">
                                <div class="img">
                                @if(count($data['thumb'])) <img src="{{ $data['thumb'] }}">@endif
                            </div></a>
                        </td>
                        <td class="text1"><b><a href="{{DOMAIN}}design/{{ $data['id'] }}">{{ $data['name'] }}</a></b>
                            <a href="{{DOMAIN}}design/{{ $data['id'] }}" class="a_to_show">详情</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text2">
                            发布者：{{ UserNameById($data['uid']) }}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            浏览次数：{{ $data['click'] }}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            发布时间：{{ $data['createTime'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text3">
                            <textarea cols="50" rows="2" readonly class="index_intro">{{ str_limit($data['intro'],80) }}</textarea>
                        </td>
                    </tr>
                    {{--@if($kdata!=1 && $kdata!=count($datas)-1)--}}
                        {{--<tr><td colspan="10"><div style="height:10px;border-top:1px dashed lightgrey;">&nbsp;</div></td></tr>--}}
                    {{--@endif--}}
                @endforeach
            @else <tr><td colspan="2"><div style="width:700px;text-align:center;">没有记录</div></td></tr>
            @endif
            </table>
        </div>
        <div style="position:relative;top:20px;left:-100px;">@include('home.common.page2')</div>

        <div class="de_right" style="margin-top:-50px;">
            {{--<div class="cate">--}}
                {{--<div class="title">分类信息</div>--}}
                {{--<div class="con">--}}
                    {{--<div class="de_con"><div></div>视频</div>--}}
                    {{--<div class="de_con"><div></div>平面</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            @if(count($ads))
                @foreach($ads as $ad)
                    <a href="{{ $ad['link'] }}">
                        <div class="img" title="{{ $ad['name'] }}">
                            <img src="{{ $ad['img'] }}">
                        </div>
                    </a>
                @endforeach
            @endif
            @if(count($ads)<2)
                @for($i=0;$i<2-Count($ads);++$i)
                    <div class="img"></div>
                @endfor
            @endif
        </div>
    </div>
    <div style="height:500px;">{{--空白--}}</div>

    <script>
        $(document).ready(function(){
            //根据浏览器宽度设置菜单位置
            var clientWidth = document.body.clientWidth;
            var de_right = $(".de_right");
            de_right.css('position','absolute');
            de_right.css('top',245+'px');
            de_right.css('right',(clientWidth-1000)/2-15+'px');
        });
    </script>
@stop