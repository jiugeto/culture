@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            需求类别：个人/企业
            &nbsp;&nbsp;&nbsp;&nbsp;
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
                        if ($(this).val()==1) {
                            window.location.href = '{{DOMAIN}}demand';
                        } else {
                            window.location.href = '{{DOMAIN}}demand/genre/'+$(this).val();
                        }
                    });
                });
            </script>
        </div>

        {{-- 列表 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_list">
            <table class="record">
                @if(count($datas))
                    @foreach($datas as $data)
                <tr>
                    <td>需求名称：{{ $data->name }}</td>
                    <td>需求方：{{ Session::has('user') ? $data->userName() : '登录可见' }}</td>
                    <td>地区：{{ Session::has('user') ? $data->areaName() : '登录可见' }}</td>
                </tr>
                <tr>
                    <td>需求类型：</td>
                    <td>时间：</td>
                    <td><a href="{{DOMAIN}}demand/{{ $data->id }}" class="toshow">详情</a></td>
                </tr>
                    @endforeach
                @else @include('home.common.norecord')
                @endif
            </table>
        </div>
        <div class="s_right">
            {{--<img src="/uploads/images/2016/ppt.png">--}}
            <div style="width:280px;height:500px;background:rgb(250,250,250);"></div>
        </div>
    </div>

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