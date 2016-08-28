@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            租金：
            <input type="text" name="fromMoney" value="{{ $fromMoney }}"> -
            <input type="text" name="toMoney" value="{{ $toMoney }}"> 元
            &nbsp;&nbsp;
            <a id="search" class="a_search">搜索</a>
            @if($fromMoney!=0||$toMoney!=0)<a href="{{DOMAIN}}rent" class="a_search">退出搜索</a>@endif
        </div>
        <script>
            $("#search").click(function(){
                var fromMoney = $("input[name='fromMoney']").val();
                var toMoney = $("input[name='toMoney']").val();
                //m代表money缩写，代表租金
                if (fromMoney==0 && toMoney==0) {
                    window.location.href = '{{DOMAIN}}rent';
                } else {
                    window.location.href = '{{DOMAIN}}rent/m/'+fromMoney+'/'+toMoney;
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
                            {{--<img src="{{PUB}}uploads/images/2016/online1.png">--}}
                            @if(count($data->getPics()))
                                <img src="{{ $pic[0]->getPicUrl() }}">
                            @else
                                <div style="width:150px;height:50px;background:rgb(250,250,250);"></div>
                            @endif
                        </div>
                    </td>
                    <td>设备：{{ str_limit($data->name,15) }}</td>
                    <td>公司：{{ str_limit($data->getUserName(),15) }}</td>
                    <td>地区：{{ $data->getAreaName() }}</td>
                </tr>
                <tr>
                    <td>租金：{{ $data->money() }}</td>
                    <td>有效期：{{ $data->period() }}</td>
                    <td><a href="{{DOMAIN}}rent/{{ $data->id }}" class="toshow">详情</a></td>
                </tr>
                @if($kdata!=1 && $kdata!=count($datas)-1)
                    <tr><td colspan="10"><div style="height:10px;border-top:1px dashed lightgrey;">&nbsp;</div></td></tr>
                @endif
                @endforeach
            @else @include('home.common.norecord')
            @endif
            </table>
        </div>
        <div class="s_right s_right_rent">
            {{--<div class="cate"></div>--}}
            @if(count($ads))
                @foreach($ads as $ad)
                    <a href="{{ $ad->link }}">
                        <div class="img" title="{{ $ad->name }}">
                            <img src="{{ $ad->getPicUrl() }}">
                        </div>
                    </a>
                @endforeach
            @endif
            @if(count($ads)<$ads->limit)
                @for($i=0;$i<$ads->limit-Count($ads);++$i)
                    <div class="img"></div>
                @endfor
            @endif
        </div>
    </div>
    <div class="cre_kong" style="height:850px;">&nbsp;{{--10px高度留空--}}</div>

    <script>
        $(document).ready(function(){
            //根据浏览器宽度设置菜单位置
            var clientWidth = document.body.clientWidth;
            var s_right = $(".s_right");
            s_right.css('position','absolute');
            s_right.css('top',225+'px');
            s_right.css('right',(clientWidth-1000)/2+10+'px');
        });
    </script>
@stop