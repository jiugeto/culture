@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            分类：
            <select name="cate" class="home_search">
                <option value="0" {{$cate==0?'selected':''}}>所有</option>
                @foreach($model['cates'] as $k=>$vcate)
                    <option value="{{$k}}" {{$cate==$k?'selected':''}}>{{$vcate}}</option>
                @endforeach
            </select>
        </div>
        <script>
            $("select[name='cate']").change(function(){
                var cate = $(this).val();
                if (cate==0) {
                    window.location.href = '{{DOMAIN}}design';
                } else {
                    window.location.href = '{{DOMAIN}}design/s/'+cate;
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
                            <a href="{{DOMAIN}}design/{{$data['id']}}" title="{{$data['name']}}">
                                <div class="img">
                                @if(count($data['thumb'])) <img src="{{$data['thumb']}}">@endif
                            </div></a>
                        </td>
                        <td class="text1"><b><a href="{{DOMAIN}}design/{{$data['id']}}">{{$data['name']}}</a></b>
                            <a href="{{DOMAIN}}design/{{$data['id']}}" class="a_to_show">详情</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text2">
                            发布者：{{UserNameById($data['uid'])}}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            浏览次数：{{$data['click']}}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            发布时间：{{$data['createTime']}}
                        </td>
                    </tr>
                    <tr>
                        <td class="text3">
                            <textarea cols="50" rows="2" readonly class="index_intro">
                                {{str_limit($data['intro'],80)}}</textarea>
                        </td>
                    </tr>
                    @if(count($datas)>1)
                        <tr><td colspan="10">
                                <div style="height:5px;border-top:1px dashed lightgrey;"></div>
                            </td></tr>
                    @endif
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
                    <a href="{{$ad['link']}}">
                        <div class="img" title="{{$ad['name']}}">
                            <img src="{{$ad['img']}}">
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
        //根据浏览器宽度设置菜单位置
        $(document).ready(function(){ setAdPos(); });
        //改变浏览器大小触发事件
        window.onresize = function(){ setAdPos(); };
        function setAdPos(){
            var clientWidth = document.body.clientWidth;
            var de_right = $(".de_right");
            //取得浏览器的userAgent字符串，得出top值
            var userAgent = window.navigator.userAgent;
            var top;
            if (userAgent.indexOf("MSIE")>0) {
                top = '265px';
            } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
                top = '280px';
            } else {
                top = '265px';
            }
            de_right.css('position','absolute');
            de_right.css('top',top);
            de_right.css('right',(clientWidth-1000)/2-15+'px');
        }
    </script>
@stop