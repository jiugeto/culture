@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            类型：
            <select name="type" class="s_search_sel">
                <option value="0" {{ $type==0 ? 'selected'  : ''}}>所有</option>
                @foreach($model['types'] as $ktype=>$vtype)
                    <option value="{{ $ktype }}" {{ $type==$ktype ? 'selected' : '' }}>{{ $vtype }}</option>
                @endforeach
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;
            租金：
            <input type="text" name="fromMoney" value="{{ $fromMoney }}"> -
            <input type="text" name="toMoney" value="{{ $toMoney }}"> 元
            &nbsp;&nbsp;
            <a id="search" class="a_search" title="点击搜索">搜索</a>
            @if($fromMoney!=0||$toMoney!=0)<a href="{{DOMAIN}}rent" class="a_search">退出搜索</a>@endif
        </div>
        <script>
            $("select[name='type']").change(function(){
                var type = $("select[name='type']").val();
                var fromMoney = $("input[name='fromMoney']").val();
                var toMoney = $("input[name='toMoney']").val();
                //m代表money缩写，代表租金
                if (type==0 && fromMoney==0 && toMoney==0) {
                    window.location.href = '{{DOMAIN}}rent';
                } else {
                    window.location.href = '{{DOMAIN}}rent/s/'+type+'/'+fromMoney+'/'+toMoney;
                }
            });
        </script>

        {{-- 列表 --}}
        {{--<div class="cre_kong">&nbsp;--}}{{--10px高度留空--}}{{--</div>--}}
        <div class="s_list">
            <table class="record">
            @if(Count($datas))
                @foreach($datas as $kdata=>$data)
                <tr>
                    <td rowspan="2" class="td_r_img">
                        <div class="r_img">
                            @if(count($data['thumb'])) <img src="{{ $data['thumb'] }}">@endif
                        </div>
                    </td>
                    <td>设备：{{ str_limit($data['name'],15) }}</td>
                    <td>公司：{{ str_limit(UserNameById($data['uid']),15) }}</td>
                    <td>地区：{{ AreaNameByid($data['area']) }}</td>
                </tr>
                <tr>
                    <td>租金：{{ $data['money'] }}</td>
                    <td>有效期：{{ $data['period'] }}</td>
                    <td><a href="{{DOMAIN}}rent/{{ $data['id'] }}" class="toshow">详情</a></td>
                </tr>
                @if($kdata!=1 && $kdata!=count($datas))
                    <tr><td colspan="10"><div style="height:10px;border-top:1px dashed lightgrey;">&nbsp;</div></td></tr>
                @endif
                @endforeach
            @else <p style="text-align:center;">没有记录</p>
            @endif
            </table>
        </div>
        <div class="s_right">
            {{--<div class="cate"></div>--}}
            @if(count($ads))
                @foreach($ads as $ad)
                    <a href="{{ $ad['link'] }}">
                        <div class="img" title="{{ $ad['name'] }}">
                            <img src="{{ $ad['img'] }}">
                        </div>
                    </a>
                @endforeach
            @endif
            @if(count($ads)<3)
                @for($i=0;$i<3-Count($ads);++$i)
                    <div class="img"></div>
                @endfor
            @endif
        </div>
    </div>
    <div class="cre_kong" style="height:850px;">&nbsp;{{--10px高度留空--}}</div>

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
                top = '220px';
            } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
                top = '240px';
            } else {
                top = '220px';
            }
            s_right.css('position','absolute');
            s_right.css('top',top);
            s_right.css('right',(clientWidth-1000)/2+'px');
        }
    </script>
@stop