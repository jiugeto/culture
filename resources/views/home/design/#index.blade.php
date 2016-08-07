@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            供求：
            <select name="genre">
                <option value="0" {{ $genre==0 ? 'selected' : '' }}>-请选择-</option>
                <option value="1" {{ $genre==1 ? 'selected' : '' }}>设备供应</option>
                <option value="2" {{ $genre==2 ? 'selected' : '' }}>设备需求</option>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;
            分类：
            <select name="type" class="home_search">
                <option value="0">所有</option>
            </select>
        </div>

        {{-- 列表 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        {{--面包屑--}}
        <div class="de_title">3D设计 > C4D</div>
        <div class="de_list">
            <table class="record">
                <tr>
                    <td rowspan="3">
                        <div class="img"><img src="/uploads/images/2016/online1.png"></div>
                    </td>
                    <td class="text1"><b>c4d作品</b></td>
                </tr>
                <tr>
                    <td class="text2">
                        发布者：
                        浏览次数：
                        回复：
                        发布时间：
                    </td>
                </tr>
                <tr>
                    <td class="text3">作品详情作品详情作品详情作品详情作品详情作品详情作品详情作品详情作品详情作品详情</td>
                </tr>
            </table>
        </div>

        <div class="de_right">
            <div class="cate">
                <div class="title">分类信息</div>
                <div class="con">
                    <div class="de_con"><div></div>视频</div>
                    <div class="de_con"><div></div>平面</div>
                </div>
            </div>
            <div class="img">
                {{--<img src="/uploads/images/2016/ppt.png">--}}
                <div style="width:260px;height:500px;background:rgb(250,250,250);"></div>
            </div>
        </div>
    </div>
    <div style="height:350px;">{{--空白--}}</div>

    <script>
        $(document).ready(function(){
            //根据浏览器宽度设置菜单位置
            var clientWidth = document.body.clientWidth;
            var de_right = $(".de_right");
            de_right.css('position','absolute');
            de_right.css('top',245+'px');
            de_right.css('right',(clientWidth-1000)/2-15+'px');
        });
    </script>
@stop