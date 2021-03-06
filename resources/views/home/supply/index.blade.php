@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            类型：
            <select name="genre" class="home_search">
                <option value="0" {{$genre==0?'selected':''}}>所有</option>
                @foreach($model['genres'] as $k=>$vgenre)
                    <option value="{{$k}}" {{$genre==$k?'selected':''}}>{{$vgenre}}</option>
                @endforeach
            </select>
            <script>
                $(document).ready(function(){
                    var genre = $("select[name='genre']");
                    genre.change(function(){
                        if (genre.val()==0) {
                            window.location.href = '{{DOMAIN}}supply';
                        } else {
                            window.location.href = '{{DOMAIN}}supply/s/'+genre.val();
                        }
                    });
                });
            </script>
        </div>

        {{-- 列表 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_list">
            @if(count($datas))
                @foreach($datas as $data)
            <table class="record">
                <tr>
                    <td>公司名称：{{str_limit($data['name'],20)}}</td>
                    <td>公司类型：{{$data['genreName']}}</td>
                    <td>地址：{{str_limit($data['address'],20)}}</td>
                </tr>
                <tr>
                    {{--<td>地区：{{$data['area']}}</td>--}}
                    <td>地区：{{AreaNameByid($data['area'],2)}}</td>
                    <td>时间：{{$data['createTime']}}</td>
                    {{--<td><a href="{{DOMAIN}}supply/{{$data->id}}" class="toshow">详情</a></td>--}}
                    <td><a href="{{DOMAIN}}c/{{$data['id']}}" class="toshow">主页</a></td>
                </tr>
            </table>
                @endforeach
            @endif
            @include('home.common.page2')
        </div>
        <div class="s_right">
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
    <div class="cre_kong" style="height:400px;">&nbsp;{{--10px高度留空--}}</div>

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
                top = '230px';
            } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
                top = '245px';
            } else {
                top = '230px';
            }
            s_right.css('position','absolute');
            s_right.css('top',top);
            s_right.css('right',(clientWidth-1000)/2+'px');
        }
    </script>
@stop