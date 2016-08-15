@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;background:0;">
        {{--页面顶部布局--}}
        <div class="per_top">
            <p class="t"><b>{{ \Session::has('user')?\Session::get('user.username'):'' }} 的个人后台</b></p>
            <p><a href="">{{ 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] }}</a></p>
            <p class="t"><b>
                    <a href="">空间首页</a> &nbsp;
                    <a href="">相册</a> &nbsp;
                    <a href="">资料</a> &nbsp;
                    <a href="">视频</a> &nbsp;
                    <a href="">作品</a> &nbsp;
                    <a href="">设计</a> &nbsp;
                </b></p>
        </div>
        {{--页面左边布局--}}
        <div class="per_left">
            <div class="per_left1">
                <p class="title">头像</p>
                <div class="img">
                    {{--<img src="##">--}}
                    <div style="margin:0;width:120px;height:100px;background:rgb(240,240,240);border:0;"></div>
                </div>
                <div class="nicheng">00</div>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td><a href="">编辑头像</a></td>
                        <td><a href="">查看留言</a></td>
                    </tr>
                </table>
            </div>
            <div class="per_left2">
                <p class="title">统计信息</p>
                <p class="cometo">已有 <span style="color:orangered;">0</span> 人来访问过</p>
                <table cellpadding="0" cellspacing="0" style="width:80%;">
                    <tr><td>积分：0</td><td>金币：0</td></tr>
                    <tr><td>好友：0</td><td>相册：0</td></tr>
                    <tr><td>日志：0</td></tr>
                </table>
            </div>
            <div class="per_left3">
                <p class="title">相册 <a href="">更多</a></p>
                <div class="img">
                    {{--<img src="">--}}
                    <div style="margin:0;width:55px;height:50px;background:rgb(240,240,240);border:0;"></div>
                </div>
                <div class="img">
                    {{--<img src="">--}}
                    <div style="margin:0;width:55px;height:50px;background:rgb(240,240,240);border:0;"></div>
                </div>
                <div class="img">
                    {{--<img src="">--}}
                    <div style="margin:0;width:55px;height:50px;background:rgb(240,240,240);border:0;"></div>
                </div>
            </div>
        </div>
        {{--页面中间布局--}}
        <div class="per_center">
            <div class="per_center1">
                <p class="title">资料 <a href="">编辑资料</a></p>
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr><td>用户名称：</td><td>真实姓名：</td></tr>
                    <tr><td>性别：</td><td>地区：</td></tr>
                </table>
            </div>
            <div class="per_center2">
                <p class="title">我的收藏 <a href="">更多</a></p>
                <div class="video">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:100px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="vname">视频名称</p>
                </div>
                <div class="video">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:100px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="vname">视频名称</p>
                </div>
            </div>
            <div class="per_center2">
                <p class="title">我的作品 <a href="">更多</a></p>
                <div class="video">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:100px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="vname">视频名称</p>
                </div>
                <div class="video">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:100px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="vname">视频名称</p>
                </div>
            </div>
            <div class="per_center3">
                <p class="title">留言板</p>
            </div>
        </div>
        {{--页面右侧布局--}}
        <div class="per_right">
            <div class="per_right1">
                <p class="title">好友 <a href="">更多</a></p>
                <div class="friend">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:50px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="nicheng">00</p>
                </div>
                <div class="friend">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:50px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="nicheng">00</p>
                </div>
                <div class="friend">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:50px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="nicheng">00</p>
                </div>
            </div>
            <div class="per_right1">
                <p class="title">最近访客 <a href="">更多</a></p>
                <div class="friend">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:50px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="nicheng">00</p>
                </div>
                <div class="friend">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:50px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="nicheng">00</p>
                </div>
            </div>
            {{--<div class="per_right2">--}}
                {{--<p class="title">最近访客</p>--}}
            {{--</div>--}}
            <div class="per_right3">
                <p class="title">设计</p>
            </div>
        </div>
        {{--<div class="per_bottom"><p>底部</p></div>--}}
    </div>
    <div style="height:50px;">{{--空白--}}</div>
@stop