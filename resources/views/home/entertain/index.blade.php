@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            搜索方式：
            <label style="cursor:pointer;">
                <input type="radio" style="border:0;" name="genre0" value="1" {{$genre0==1?'checked':''}}
                    onclick="window.location.href='{{DOMAIN}}entertain';"> 讯息
            </label>
            <label style="cursor:pointer;">
                <input type="radio" style="border:0;" name="genre0" value="2" {{$genre0==2?'checked':''}}
                    onclick="window.location.href='{{DOMAIN}}entertain/s/2/0';"> 人员
            </label>
            <label style="cursor:pointer;">
                <input type="radio" style="border:0;" name="genre0" value="3" {{$genre0==3?'checked':''}}
                    onclick="window.location.href='{{DOMAIN}}entertain/s/3/0';"> 作品
            </label>
            <input type="hidden" name="genre_0" value="{{$genre0}}">
            @if($genre0==2)
            &nbsp;&nbsp;&nbsp;&nbsp;
            人员：
            <select class="home_search" name="type" onchange="getSel(this.value)">
                <option value="0" {{$type==0?'selected':''}}>所有</option>
                @foreach($staffModel['types'] as $k=>$vtype)
                    <option value="{{$k}}" {{$type==$k?'selected':''}}>{{$vtype}}</option>
                @endforeach
            </select>
            <script>
                function getSel(val){
                    var genre0 = $("input[name='genre_0']").val();
                    if (genre0==1) {
                        window.location.href = '{{DOMAIN}}entertain';
                    } else if (genre0==2) {
                        window.location.href = '{{DOMAIN}}entertain/s/2/'+val;
                    }
                }
            </script>
            @endif
        </div>

        {{-- 列表 --}}
        <div class="e_list">
            <table class="record" @if(!count($datas))style="border:0;"@endif>
            @if(count($datas))
                @foreach($datas as $k=>$data)
                    <tr>
                        <td><div style="color:lightgrey;text-align:center;">{{date('Y',$data['created_at'])}}
                                <div style="border-bottom:1px solid lightgrey;"></div>{{date('m',$data['created_at'])}}
                            </div>
                        </td>
                        <td>
                            <div class="img">
                                @if($data['thumb']) <img src="{{$data['thumb']}}">
                                @else <div style="width:280px;height:500px;background:rgb(250,250,250);"></div>
                                @endif
                            </div>
                        </td>
                        @if($genre0==1)
                            {{--公司列表--}}
                            <td>
                                <div class="title"><b>标题：{{$data['title']}}</b></div>
                                <div class="con"><textarea cols="40" rows="2" readonly class="index_intro">
                                        {{str_limit($data['intro'],40)}}</textarea></div>
                            </td>
                            <td>
                                <div class="comName">公司：{{ComNameByUid($data['uid'])}}</div>
                                <p><a href="{{DOMAIN}}entertain/{{$data['id']}}" class="toshow">详情</a></p>
                            </td>
                        @elseif($genre0==2)
                            {{--人员--}}
                            <td>
                                <div class="title"><b>艺名：{{$data['name']}}</b></div>
                                <div class="con"><textarea cols="40" rows="2" readonly style="border:0;resize:none;">
                                    {{str_limit($data->intro,40)}}</textarea></div>
                            </td>
                            <td>
                                <div class="comName">公司：{{ComNameByUid($data['uid'])}}</div>
                                <p><a href="{{DOMAIN}}entertain/staff/show/{{$data['id']}}" class="toshow">详情</a></p>
                            </td>
                        @elseif($genre0==3)
                            {{--人员--}}
                            <td>
                                <div class="title"><b>影视作品：{{$data['name']}}</b></div>
                                <div class="con"><textarea cols="40" rows="2" readonly style="border:0;resize:none;">
                                    {{str_limit($data['intro'],40)}}</textarea></div>
                            </td>
                            <td>
                                <div class="comName">公司：{{ComNameByUid($data['uid'])}}</div>
                                <p><a href="{{DOMAIN}}entertain/works/show/{{$data['id']}}" class="toshow">详情</a></p>
                            </td>
                        @endif
                    </tr>
                    @if($k!=1 && $k!=count($datas))
                    <tr><td colspan="10"><div style="height:10px;border-top:1px dashed lightgrey;">&nbsp;</div></td></tr>
                    @endif
                @endforeach
            @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
            @endif
            </table>
            @include('home.common.page2')
        </div>
        <div class="e_right">
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

    <script>
        //根据浏览器宽度设置菜单位置
        $(document).ready(function(){ setAdPos(); });
        //改变浏览器大小触发事件
        window.onresize = function(){ setAdPos(); };
        function setAdPos(){
            var clientWidth = document.body.clientWidth;
            var e_right = $(".e_right");
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
            e_right.css('position','absolute');
            e_right.css('top',top);
            e_right.css('right',(clientWidth-1000)/2+'px');
        }
    </script>
@stop