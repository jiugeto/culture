@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            需求类型：
            <select name="genre" class="home_search">
                @foreach($genres as $kgenre=>$vgenre)
                <option value="{{ $kgenre }}" {{ $genre==$kgenre ? 'selected' : '' }}>{{ $vgenre }}</option>
                @endforeach
            </select>
            {{--&nbsp;&nbsp;&nbsp;&nbsp;--}}
            {{--视频类型：--}}
            {{--<select name="genre1" class="home_search">--}}
                {{--<option value="0">-请选择-</option>--}}
            {{--</select>--}}
            <script>
                $(document).ready(function(){
                    $("select[name='genre']").change(function(){
                        if ($(this).val()==2) {
                            window.location.href = '{{DOMAIN}}demand';
                        } else {
                            window.location.href = '{{DOMAIN}}demand/s/'+$(this).val();
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
                    <td>需求名称：{{ $data['name'] }}</td>
                    <td>需求方：{{ Session::has('user') ? $data['uname'] : '登录可见' }}</td>
                    <td>地区：{{ Session::has('user') ? AreaNameByid($data['area']) : '登录可见' }}</td>
                </tr>
                <tr>
                    <td>需求类型：
                        @if($genre==1)视频@elseif($genre==2)创意@elseif($genre==3)分镜@elseif($genre==4)人员
                        @elseif($genre==4)设备@else设计@endif
                    </td>
                    <td>时间：{{$data['createTime']}}</td>
                    <td><a href="{{DOMAIN}}demand/{{ $data['id'] }}" class="toshow">详情</a></td>
                </tr>
            </table>
                @endforeach
            @else
                <p style="text-align:center;color:grey;">
                    没有@if($genre==1)视频@elseif($genre==2)创意@elseif($genre==3)分镜@elseif($genre==4)人员@elseif($genre==4)设备@else设计@endif记录</p>
            @endif
        </div>
        <div class="s_right" style="margin-top:-15px;">
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
                @for($i=0;$i<2-count($ads);++$i)
                    <div class="img"></div>
                @endfor
            @endif
        </div>
    </div>
    <div class="cre_kong" style="height:500px;">&nbsp;{{--10px高度留空--}}</div>

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