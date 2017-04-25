@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div style="height:2px;">{{--空白--}}</div>
    <div class="pro_content">
        @include('home.product.menu')

        {{-- 一楼 --}}
        <div class="pro_floor">
            {{--标题列表--}}
            <div class="pro_big">
                <p>推荐的样片</p>
                <ul>
                    @if(count($recommends))
                        @foreach($recommends as $recommend)
                    <li><a href="{{DOMAIN}}product/{{$recommend['id']}}">{{$recommend['name']}}</a></li>
                        @endforeach
                    @else
                        @for($i=0;$i<4-count($recommends);++$i)
                    <li><span>没有推荐</span></li>
                        @endfor
                    @endif
                </ul>
            </div>
            {{--大图--}}
            <div class="pro_big">
                @if(count($recommends))
                    <div class="img"><img src="{{$recommends[0]['thumb']}}"></div>
                    <a href="{{DOMAIN}}product/{{$recommend['id']}}">{{$recommends[0]['name']}}</a>
                @else
                    <div class="img"><div class="none">无</div></div>
                    <a href="">没有推荐大图</a>
                @endif
            </div>
            {{--小图--}}
            <div class="pro_big2">
                @if(count($recommends))
                    @foreach($recommends as $recommend)
                <div class="img_text">
                    <div class="img">
                        <a href="{{DOMAIN}}product/{{$recommend['id']}}">
                            <img src="{{$recommend['thumb']}}" border="0">
                        </a>
                    </div>
                    <div class="text"><a href="{{DOMAIN}}product/{{$recommend['id']}}">{{$recommend['name']}}</a></div>
                </div>
                    @endforeach
                @endif
                @if(count($recommends)<4)
                    @for($i=0;$i<4-count($recommends);++$i)
                <div class="img_text">
                    <div class="img">
                        <a href=""><div class="none">无</div></a>
                    </div>
                    <div class="text"><a href="">没有推荐</a></div>
                </div>
                    @endfor
                @endif
            </div>
        </div>
        <br style="clear:both;"><br>

        {{-- 二楼：原创产品集 --}}
        <div class="pro_floor">
            <div class="title">最新的样片</div>
            {{-- 原创视频 --}}
            <div class="original">
                @if(count($newests))
                    @foreach($newests as $newest)
                <div class="img_text">
                    <div class="img">
                        <a href="{{DOMAIN}}product/{{$newest['id']}}">
                            <img src="{{$newest['thumb']}}" border="0">
                        </a>
                    </div>
                    <div class="text">
                        <a href="{{DOMAIN}}product/{{$newest['id']}}">{{$newest['name']}}</a>
                        {{--<span style="color:red;float:right;">{{ $newest['click'] }}</span>--}}
                    </div>
                </div>
                    @endforeach
                @endif
                @if(count($newests)<8)
                    @for($i=0;$i<8-count($newests);++$i)
                <div class="img_text">
                    <div class="img">
                        <a href=""><div class="none">无</div></a>
                    </div>
                    <div class="text"><a href="">没有原创</a></div>
                </div>
                    @endfor
                @endif
            </div>
            {{-- 公司信息 --}}
            <div class="pro_com">
                <div class="privateInfo">
                    <div class="title">公司</div>
                    @if(count($comNewests))
                        @foreach($comNewests as $newest)
                    <div class="img_text">
                        {{--<div class="img_num"> 1 </div>--}}
                        <div class="img">
                            <a href="{{DOMAIN}}product/{{$newest['id']}}">
                                <img src="{{$newest['thumb']}}" border="0">
                            </a>
                        </div>
                        <a href="{{DOMAIN}}product/{{$newest['id']}}">{{str_limit($newest['name'],10)}}</a>
                        {{--<a href="" class="click">点击<span>{{$newest['click']}}</span></a>--}}
                    </div>
                        @endforeach
                    @endif
                    @if(count($comNewests)<7)
                        @for($i=0;$i<7-count($comNewests);++$i)
                    <div class="img_text">
                        <div class="img_num"> 1 </div>
                        <div class="img">
                            <a href=""><div class="none">无</div></a>
                        </div>
                        <a href="">无最新样片</a>
                        {{--<a href="" class="click">点击<span>0</span></a>--}}
                    </div>
                        @endfor
                    @endif
                </div>
            </div>
            {{-- 设计师信息 --}}
            <div class="pro_per">
                <div class="privateInfo">
                    <div class="title">设计师</div>
                    @if(count($pNewests))
                        @foreach($pNewests as $newest)
                    <div class="img_text">
                        {{--<div class="img_num"> 1 </div>--}}
                        <div class="img">
                            <a href="{{DOMAIN}}product/{{$newest['id']}}">
                                <img src="{{$newest['thumb']}}" border="0">
                            </a>
                        </div>
                        <a href="{{DOMAIN}}product/{{$newest['id']}}">{{str_limit($newest['name'],10)}}</a>
                        {{--<a href="" class="click">点击<span>{{$newest['click']}}</span></a>--}}
                    </div>
                        @endforeach
                    @endif
                    @if(count($pNewests)<7)
                        @for($i=0;$i<7-count($pNewests);++$i)
                    <div class="img_text">
                        {{--<div class="img_num"> 1 </div>--}}
                        <div class="img">
                            {{--<a href=""><div class="none">无</div></a>--}}
                        </div>
                        <a href="">无最新样片</a>
                        {{--<a href="" class="click">点击<span>0</span></a>--}}
                    </div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <br style="clear:both;"><br>

        <div style="border-bottom:1px solid rgba(240,240,240,1);"></div>

        {{-- 猜你喜欢 --}}
        {{--<div class="pro_floor">--}}
            {{--<div class="title">猜你喜欢</div>--}}
            {{--<div class="guess">--}}
                {{--<div class="img_text">--}}
                    {{--<div class="img">--}}
                        {{--<a href=""><img src="{{PUB}}uploads/images/2016/online1.png"></a>--}}
                    {{--</div>--}}
                    {{--<div class="text"><a href="">原创视频</a></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<br style="clear:both;"><br>--}}

        {{-- 宣传片 --}}
        @if(count($xuanchuans))
        <div class="pro_floor">
            <div class="title">宣传片</div>
            <div class="pro_cate">
                @foreach($xuanchuans as $xuanchuan)
                    <div class="img_text">
                        <div class="img">
                            <a href="{{DOMAIN}}product/{{$xuanchuan['id']}}">
                                <img src="{{$xuanchuan['thumb']}}" border="0">
                            </a>
                        </div>
                        <a href="">{{$xuanchuan['name']}}</a>
                    </div>
                @endforeach
            </div>
        </div>
        <br style="clear:both;"><br>
        @endif
    </div>
@stop