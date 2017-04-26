@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        <div class="cre_kong">&nbsp;</div>
        <div class="s_search">
            类型：
            <select name="genre" class="home_search" onchange="getSel(this.value)">
                <option value="0" {{$genre==0?'selected':''}}>所有</option>
                @foreach($model['genres'] as $k=>$vgenre)
                    <option value="{{$k}}" {{$genre==$k?'selected':''}}>{{$vgenre}}</option>
                @endforeach
            </select>
        </div>
        <div class="cre_kong">&nbsp;</div>
        <div class="s_list">
            @if(count($datas))
                @foreach($datas as $data)
            <table class="record" style="color:#808080;">
                <tr>
                    <td width="100">投放名称：{{$data['name']}}</td>
                    <td width="100">类型：{{$data['genreName']}}</td>
                    <td rowspan="4" style="width:200px;height:80px;background:#f6f6f6;overflow:hidden;">
                        <img src="{{$data['thumb']}}" width="200" border="0">
                    </td>
                </tr>
                <tr>
                    <td>投放开始：{{date('Y-m-d H:i:s',$data['fromtime'])}}</td>
                    <td>投放结束：{{date('Y-m-d H:i:s',$data['totime'])}}</td>
                </tr>
                <tr>
                    <td>价格(元)：{{$data['money']}}</td>
                    <td>发布时间：{{$data['createTime']}}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <a href="{{DOMAIN}}delivery/{{$data['id']}}" class="toshow" style="padding:2px 100px;">查 看</a>
                    </td>
                </tr>
            </table>
                @endforeach
            @else <p style="color:#808080;text-align:center;">没有记录</p>
            @endif
            {{--<table class="record" style="color:#808080;">--}}
                {{--<tr>--}}
                    {{--<td width="100">投放名称：</td>--}}
                    {{--<td width="100">类型：</td>--}}
                    {{--<td rowspan="4" style="width:200px;height:80px;background:#f6f6f6;overflow:hidden;">--}}
                        {{--未上传--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td>投放开始：</td>--}}
                    {{--<td>投放结束：</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td>价格：</td>--}}
                    {{--<td>发布时间：</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td colspan="2" style="text-align:center;">--}}
                        {{--<a href="" class="toshow" style="padding:2px 100px;">查 看</a>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--</table>--}}
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
        function getSel(val){
            if (val==0) {
                window.location.href = '{{DOMAIN}}delivery';
            } else {
                window.location.href = '{{DOMAIN}}delivery/s/'+val;
            }
        }
    </script>
@stop