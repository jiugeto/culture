@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            公司类型：
            <select name="genre" class="home_search">
                <option value="0" {{ $genre==0 ? 'selected' : '' }}>-所有-</option>
                @foreach($model['genres'] as $kgenre=>$vgenre)
                    <option value="{{ $kgenre }}" {{ $genre==$kgenre ? 'selected' : '' }}>{{ $vgenre }}</option>
                @endforeach
            </select>
            <script>
                $(document).ready(function(){
                    var genre = $("select[name='genre']");
                    genre.change(function(){
                        if (genre.val()==0) {
                            window.location.href = '/supply';
                        } else {
                            window.location.href = '/'+genre.val()+'/supply';
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
                    <td>公司名称：{{ $data->name }}</td>
                    <td>地址：{{ $data->address }}</td>
                    <td>业务：</td>
                </tr>
                <tr>
                    <td>地区：{{ $data->areaName() }}</td>
                    <td>时间：{{ $data->createTime() }}</td>
                    <td></td>
                </tr>
                    @endforeach
                @endif
            </table>
            <table class="record">
                <tr>
                    <td>公司名称：</td>
                    <td>地址：</td>
                    <td>职能：</td>
                </tr>
                <tr>
                    <td>地区：</td>
                    <td>时间：</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="s_right">
            <img src="/uploads/images/2016/ppt.png">
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