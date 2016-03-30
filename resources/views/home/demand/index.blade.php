@extends('home.main')
@section('content')
    {{-- 需求信息模板 --}}
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">首页 / 需求信息</div>
        </div>
    </div>

    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            搜索：
            <select name="">
                <option value="0">-请选择-</option>
            </select>
        </div>

        {{-- 列表 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_list">
            <table class="record">
                <tr>
                    <td>需求片名：</td>
                    <td>地址：</td>
                    <td>需求方：</td>
                </tr>
                <tr>
                    <td>地区：</td>
                    <td>时间：</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="s_right">
            <img src="/upload/images/ppt.png">
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