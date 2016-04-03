@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            前期类型：
            <select class="s_select" name="">
                <option value="0">-请选择-</option>
                <option value="1">公司供求</option>
                <option value="2">演员供求</option>
                <option value="3">导演供求</option>
                <option value="4">摄影师供求</option>
                <option value="5">灯光师供求</option>
                <option value="6">化妆师供求</option>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;
            后期类型：
            <select class="s_select" name="">
                <option value="0">-请选择-</option>
                <option value="1">剪辑师供求</option>
                <option value="2">特效师供求</option>
                <option value="3">合成师供求</option>
                <option value="4">配音供求</option>
                <option value="5">背景音供求</option>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;
            {{--搜索：--}}
            {{--<select name="">--}}
                {{--<option value="0">-请选择-</option>--}}
            {{--</select>--}}
        </div>

        {{-- 列表 --}}
        {{--<div class="cre_kong">&nbsp;--}}{{--10px高度留空--}}{{--</div>--}}
        <div class="e_list">
            <table class="record">
                <tr><td colspan="4" class="title"><b>公司供应</b></td></tr>
                <tr>
                    <td>
                        <div class="img"><img src="/uploads/images/2016/online1.png"></div>
                        <p class="title">公司名称</p>
                        <p>供应：</p>
                    </td>
                    <td>
                        <div class="img"><img src="/uploads/images/2016/online1.png"></div>
                        <p class="title">公司名称</p>
                        <p>供应：</p>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <table class="record">
                <tr><td colspan="4" class="title"><b>公司需求</b></td></tr>
                <tr>
                    <td>
                        <div class="img"><img src="/uploads/images/2016/online1.png"></div>
                        <p class="title">公司名称</p>
                        <p>供应：</p>
                    </td>
                    <td>
                        <div class="img"><img src="/uploads/images/2016/online1.png"></div>
                        <p class="title">公司名称</p>
                        <p>供应：</p>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="e_right">
            <img src="/uploads/images/2016/ppt.png">
        </div>
    </div>

    <script>
        $(document).ready(function(){
            //根据浏览器宽度设置菜单位置
            var clientWidth = document.body.clientWidth;
            var s_right = $(".s_right");
            var e_right = $(".e_right");
            s_right.css('position','absolute');
            s_right.css('top',235+'px');
            s_right.css('right',(clientWidth-1000)/2+10+'px');
            e_right.css('position','absolute');
            e_right.css('top',235+'px');
            e_right.css('right',(clientWidth-1000)/2+10+'px');
        });
    </script>
@stop