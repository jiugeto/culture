@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;background:0;">
        {{--页面顶部布局--}}
        @include('person.partials.top')

        {{--页面左边布局--}}
        <div class="per_left">
            <div class="per_left1">
                <p class="title">头像</p>
                <div class="img">
                    @if($user && $user->head())
                    <img src="{{ $user->head() }}" style="@if($size=$user->getUserPicSize($user,$w=120,$h=100)) width:{{$size}}px; @endif height:100px;">
                    @else
                    <div style="margin:0;width:120px;height:100px;background:rgb(240,240,240);border:0;"></div>
                    @endif
                </div>
                <div class="nicheng">{{ $user->username }}</div>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td><a href="{{DOMAIN}}person/user/gethead">编辑头像</a></td>
                        <td><a href="{{DOMAIN}}person/message">查看留言</a></td>
                    </tr>
                    <tr>
                        <td><a href="{{DOMAIN}}person/user/{{$user->id}}/edit">资料编辑</a></td>
                        <td><a href="{{DOMAIN}}person/user/getpwd">更新密码</a></td>
                    </tr>
                </table>
            </div>
            <div class="per_left2">
                <p class="title">统计信息</p>
                <p class="cometo">已有 <span style="color:orangered;">0</span> 人来访问过</p>
                <table cellpadding="0" cellspacing="0" style="width:90%;">
                    <tr><td>积分：0</td><td>金币：0</td></tr>
                    <tr><td>好友：0</td><td>相册：0</td></tr>
                    <tr><td>收藏：0</td><td>作品：0</td></tr>
                    <tr><td>设计：0</td><td>好友：0</td></tr>
                    <tr><td>周访客：0</td><td>留言：0</td></tr>
                </table>
            </div>
            <div class="per_left3">
                <p class="title">相册 <a href="{{DOMAIN}}/person/pic">更多</a></p>
                @if(count($pics))
                    @foreach($pics as $pic)
                <div class="img">
                    @if($pic->url)
                    <img src="{{ $pic->url }}" style="@if($size=$pic->getPicSize($pic,$w=55,$h=50)) width:{{$size}}px; @endif height:50px;">
                    @else
                    <div style="margin:0;width:55px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    @endif
                </div>
                    @endforeach
                @endif
                @if(count($pics)<9)
                    @for($i=0;$i<9-count($pics);++$i)
                <div class="img">
                    {{--<img src="">--}}
                    <div style="margin:0;width:55px;height:50px;background:rgb(240,240,240);border:0;"></div>
                </div>
                    @endfor
                @endif
            </div>
        </div>

        {{--页面中间布局--}}
        <div class="per_center">
            <div class="per_center1">
                <p class="title">资料 <a href="{{DOMAIN}}person/user/{{ $user->id }}/edit">编辑资料</a></p>
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr><td>用户名称：{{ $user->username }}</td><td>真实姓名：{{ $user->realname() }}</td></tr>
                    <tr><td>性别：{{ $user->sex() }}</td><td>地区：{{ $user->getAreaName() }}</td></tr>
                </table>
            </div>
            <div class="per_center2">
                <p class="title">我的视频 [
                    <span id="g_all" style="color:{{$g_type==0?'red':'grey'}};">全部</span> |
                    <span id="g_collect" style="color:{{$g_type==1?'red':'grey'}};">收集的</span> |
                    <span id="g_create" style="color:{{$g_type==2?'red':'grey'}};">发布的</span>
                    ] <a href="{{DOMAIN}}person/video">更多</a>
                </p>
                @if(count($goods))
                    @foreach($goods as $good)
                <a href="{{DOMAIN}}person/video/pre/{{ $good->id }}" target="_blank">
                    <div class="video">
                        <div class="img">
                            @if($good->getPicUrl())
                            <img src="{{ $good->getPicUrl() }}" style="@if($size=$good->getPicSize($w=100,$h=50)) width:{{$size}}px; @endif height:50px;">
                            @else
                            <div style="margin:0;width:100px;height:50px;background:rgb(240,240,240);border:0;"></div>
                            @endif
                        </div>
                        <p class="vname">{{ $good->name }}</p>
                    </div>
                </a>
                    @endforeach
                @endif
                @if(count($goods)<10)
                    @for($i=0;$i<10-count($goods);++$i)
                <a href=""><div class="video">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:100px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="vname">视频名称</p>
                </div></a>
                    @endfor
                @endif
            </div>
            <div class="per_center2">
                <p class="title">我的作品 [
                    <span id="p_collect" style="color:{{$p_type==1?'red':'grey'}};">收集的</span> |
                    <span id="p_create" style="color:{{$p_type==2?'red':'grey'}};">发布的</span>
                    ] <a href="{{DOMAIN}}person/product">更多</a></p>
                @if(count($products))
                    @foreach($products as $product)
                <a href=""><div class="video">
                    <div class="img">
                        @if($product->getPicUrl())
                        <img src="{{ $product->getPicUrl() }}" style="@if($size=$product->getPicSize($w=100,$h=50)) width:{{$size}}px; @endif height:50px;">
                        @else
                        <div style="margin:0;width:100px;height:50px;background:rgb(240,240,240);border:0;"></div>
                        @endif
                    </div>
                    <p class="vname">{{ $product->name }}</p>
                </div></a>
                    @endforeach
                @endif
                @if(count($products)<10)
                    @for($i=0;$i<10-count($products);++$i)
                <a href=""><div class="video">
                    <div class="img">
                        {{--<img src="##">--}}
                        <div style="margin:0;width:100px;height:50px;background:rgb(240,240,240);border:0;"></div>
                    </div>
                    <p class="vname">视频名称</p>
                </div></a>
                    @endfor
                @endif
            </div>
            <div class="per_center3">
                <p class="title">留言板 <a href="{{DOMAIN}}person/message">更多</a></p>
                @if(count($messages))
                    @foreach($messages as $message)
                <div class="message">
                    <textarea disabled>&nbsp;&nbsp;{{ str_limit($message->intro,100) }}</textarea>
                    <p>来自 {{ $message->getUserName() }} &nbsp;&nbsp;&nbsp;&nbsp; 发送于 {{ $message->createTime() }}</p>
                </div>
                    @endforeach
                @endif
                @if(count($messages)<2)
                    @for($i=0;$i<2-count($messages);++$i)
                <div class="message">
                    <textarea disabled>&nbsp;&nbsp;消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容消息内容</textarea>
                    <p>来自 某某 &nbsp;&nbsp;&nbsp;&nbsp; 某年某月</p>
                </div>
                    @endfor
                @endif
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
                <p class="title">最近一周访客 <a href="">更多</a></p>
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
                <p class="title">设计 [
                    <span id="d_collect" style="color:{{$d_type==1?'red':'grey'}};">收集的</span> |
                    <span id="d_create" style="color:{{$d_type==2?'red':'grey'}};">发布的</span>
                    ] <a href="{{DOMAIN}}person/design">更多</a></p>
                <div class="img">
                    {{--<img src="">--}}
                    <div style="margin:0;width:80px;height:100px;background:rgb(240,240,240);border:0;"></div>
                </div>
                <div class="img">
                    {{--<img src="">--}}
                    <div style="margin:0;width:80px;height:100px;background:rgb(240,240,240);border:0;"></div>
                </div>
            </div>
        </div>
        {{--<div class="per_bottom"><p>底部</p></div>--}}
    </div>
    {{--<div style="height:100px;">--}}{{--空白--}}{{--</div>--}}

    <input type="hidden" name="g_type" value="{{ $g_type }}">
    <input type="hidden" name="p_type" value="{{ $p_type }}">
    <input type="hidden" name="d_type" value="{{ $d_type }}">
    <script>
        $(document).ready(function(){
            var g_type = $("input[name='g_type']");
            var p_type = $("input[name='p_type']");
            var d_type = $("input[name='d_type']");
            $("#g_all").click(function(){ window.location.href='{{DOMAIN}}person/space'; });
            $("#g_collect").click(function(){ window.location.href='{{DOMAIN}}person/space/s/1/'+p_type.val()+'/'+d_type.val(); });
            $("#g_create").click(function(){ window.location.href='{{DOMAIN}}person/space/s/2/'+p_type.val()+'/'+d_type.val(); });
            $("#p_collect").click(function(){ window.location.href='{{DOMAIN}}person/space'; });
            $("#p_create").click(function(){ window.location.href='{{DOMAIN}}person/space/s/'+g_type.val()+'/'+2+'/'+d_type.val(); });
            $("#d_collect").click(function(){ window.location.href='{{DOMAIN}}person/space'; });
            $("#d_create").click(function(){ window.location.href='{{DOMAIN}}person/space/s/'+g_type.val()+'/'+p_type.val()+'/'+2; });
        });
    </script>
@stop