@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            需求类型：
            <select name="genre" class="home_search" onchange="getSel(this.value)">
                @foreach($genres as $k=>$vgenre)
                <option value="{{$k}}" {{$genre==$k?'selected':''}}>{{$vgenre}}</option>
                @endforeach
            </select>
        </div>

        {{-- 列表 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_list">
            @if(count($datas))
                @foreach($datas as $data)
            <table class="record">
                <tr>
                    <td>需求名称：{{$data['name']}}</td>
                    <td>需求方：{{Session::has('user')?$data['uname']:'登录可见'}}</td>
                    <td>地区：{{Session::has('user')?AreaNameByid($data['area']):'登录可见'}}</td>
                </tr>
                <tr>
                    <td>需求类型：
                        @if($genre==1)视频
                        @elseif($genre==2)创意
                        @elseif($genre==3)分镜
                        @elseif($genre==4)人员
                        @elseif($genre==4)设备
                        @else设计
                        @endif
                    </td>
                    <td>时间：{{$data['createTime']}}</td>
                    <td><a href="{{DOMAIN}}demand/{{$genre}}/{{$data['id']}}" class="toshow">详情</a></td>
                </tr>
            </table>
                @endforeach
            @else
                <p style="text-align:center;color:grey;">
                    没有
                    @if($genre==1)人员
                    @elseif($genre==2)故事
                    @elseif($genre==3)设备
                    @elseif($genre==4)设计
                    @endif
                    记录
                </p>
            @endif
        </div>
        <div class="s_right" style="margin-top:-15px;">
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
                @for($i=0;$i<2-count($ads);++$i)
                    <div class="img">广告链接</div>
                @endfor
            @endif
        </div>
    </div>
    <div class="cre_kong" style="height:500px;">&nbsp;{{--10px高度留空--}}</div>

    <script>
        //根据浏览器宽度设置菜单位置
        $(document).ready(function(){ setAdPos(); });
        //改变浏览器大小触发事件
        window.onresize = function(){ setAdPos(); };
        function setAdPos(){
            var clientWidth = document.body.clientWidth;
            var s_right = $(".s_right");
            //取得浏览器的userAgent字符串，得出top值
            var userAgent = window.navigator.userAgent;
            var top;
            if (userAgent.indexOf("MSIE")>0) {
                top = '250px';
            } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
                top = '265px';
            } else {
                top = '250px';
            }
            s_right.css('position','absolute');
            s_right.css('top',top);
            s_right.css('right',(clientWidth-1000)/2+'px');
        }
        //需求页面检索
        function getSel(val){
            if (val==1) {
                window.location.href = '{{DOMAIN}}demand';
            } else {
                window.location.href = '{{DOMAIN}}demand/s/'+val;
            }
        }
    </script>
@stop