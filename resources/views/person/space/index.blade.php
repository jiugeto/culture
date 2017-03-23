@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;background:0;">
        {{--页面顶部布局--}}
        @include('person.common.top')

        {{--页面左边布局--}}
        <div class="per_left">
            <div class="per_left1">
                <p class="title">头像</p>
                <div class="img">
                @if($user && $user['head'])
                    <img src="{{$user['head']}}" width="120">
                @endif
                </div>
                <div class="nicheng">{{$user['username']}}</div>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td><a href="{{DOMAIN}}person/user/gethead">编辑头像</a></td>
                        <td><a href="{{DOMAIN}}person/message">查看留言</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{DOMAIN}}person/user/{{$user['id']}}/edit">资料编辑</a></td>
                        <td><a href="{{DOMAIN}}person/user/getpwd">更新密码</a></td>
                    </tr>
                </table>
            </div>
            <div class="per_left2">
                <p class="title">统计信息</p>
                <p class="cometo">业务学习统计</p>
                <table cellpadding="0" cellspacing="0" style="width:90%;">
                    <tr>
                        <td>视频：{{$goodsNum}}</td>
                        <td>作品：{{$productNum}}</td>
                    </tr>
                    <tr>
                        <td>设计：{{$designNum}}</td><td></td>
                    </tr>
                </table>
                <p class="cometo">福利统计</p>
                <table cellpadding="0" cellspacing="0" style="width:90%;">
                    <tr>
                        <td>签到：{{$signNum}}</td>
                        <td>金币：{{$goldNum}}</td>
                    </tr>
                    <tr>
                        <td>红包：{{$tipNum}}</td>
                        <td>积分：{{$integralNum}}</td>
                    </tr>
                </table>
                <p class="cometo">交流统计</p>
                <table cellpadding="0" cellspacing="0" style="width:90%;">
                    <tr><td>好友：0</td><td></td></tr>
                </table>
            </div>
        </div>

        {{--页面中间布局--}}
        <div class="per_center">
            <div class="per_center1">
                <p class="title">资料 <a href="{{DOMAIN}}person/user/{{$user['id']}}/edit">编辑资料</a></p>
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>用户名称：{{$user['username']}}</td>
                        <td>真实姓名：{{$user['realname']}}</td>
                    </tr>
                    <tr>
                        <td>性别：{{$user['sexName']}}</td>
                        <td>地区：{{$user['areaName']}}</td>
                    </tr>
                </table>
            </div>
            <div class="per_center2">
                <p class="title">我的视频
                    <a href="{{DOMAIN}}person/video">更多</a>
                </p>
                @if(count($goods))
                    @foreach($goods as $good)
                <a href="{{DOMAIN}}person/video/pre/{{$good['id']}}" target="_blank">
                    <div class="video">
                        <div class="img">
                            @if($good['thumb']) <img src="{{$good['thumb']}}" width="100"> @endif
                        </div>
                        <p class="vname">{{$good['name']}}</p>
                    </div>
                </a>
                    @endforeach
                @else <p style="text-align:center;line-height:50px;color:grey;">没有视频</p>
                @endif
            </div>
            <div class="per_center2">
                <p class="title">我的作品
                    <a href="{{DOMAIN}}person/product">更多</a>
                </p>
                @if(count($products))
                    @foreach($products as $product)
                <a href=""><div class="video">
                    <div class="img">
                        @if($product['thumb'])
                            <img src="{{$product['thumb']}}" width="100">
                        @endif
                    </div>
                    <p class="vname">{{$product['name']}}</p>
                </div></a>
                    @endforeach
                @else <p style="text-align:center;line-height:50px;color:grey;">没有作品</p>
                @endif
            </div>
        </div>

        {{--页面右侧布局--}}
        <div class="per_right">
            <div class="per_right1">
                <p class="title">好友 <a href="{{DOMAIN}}person/frield">更多</a></p>
                @if(count($frields))
                    @foreach($frields as $frield)
                <div class="friend">
                    @if($frield['uid']!=Session::get('user.uid'))
                    <div class="img"><div class="imgHidden">
                        @if($frield['user_pic'])<img src="">@endif
                        </div></div>
                    <p class="nicheng">{{$frield['username']}}</p>
                    @else
                    <div class="img"><div class="imgHidden">
                        @if($frield['frield_pic'])<img src="">@endif
                        </div></div>
                    <p class="nicheng">{{$frield['frieldName']}}</p>
                    @endif
                </div>
                    @endforeach
                @else <p style="text-align:center;line-height:50px;color:grey;">没有好友</p>
                @endif
            </div>
            {{--<div class="per_right1">--}}
                {{--<p class="title">最近一周访客 <a href="">更多</a></p>--}}
                {{--<div class="friend">--}}
                    {{--<div class="img">--}}
                        {{--<div style="margin:0;width:50px;height:50px;background:rgb(240,240,240);border:0;"></div>--}}
                    {{--</div>--}}
                    {{--<p class="nicheng">00</p>--}}
                {{--</div>--}}
                {{--<div class="friend">--}}
                    {{--<div class="img">--}}
                        {{--<div style="margin:0;width:50px;height:50px;background:rgb(240,240,240);border:0;"></div>--}}
                    {{--</div>--}}
                    {{--<p class="nicheng">00</p>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="per_right2">--}}
                {{--<p class="title">最近访客</p>--}}
            {{--</div>--}}
            <div class="per_right3">
                <p class="title">设计
                    <a href="{{DOMAIN}}person/design">更多</a>
                </p>
                @if(count($designs))
                    @foreach($designs as $design)
                <div class="img">
                    @if($design['thumb'])
                        <img src="{{$design['thumb']}}" width="80">
                    @endif
                </div>
                    @endforeach
                @else <p style="text-align:center;line-height:50px;color:grey;">没有设计</p>
                @endif
            </div>
        </div>
        {{--<div class="per_bottom"><p>底部</p></div>--}}
    </div>
@stop