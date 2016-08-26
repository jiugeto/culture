@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div style="height:2px;">{{--空白--}}</div>
    <div class="pro_content">
        {{-- 产品广告位 --}}
        <div class="pro_ad">
            <div class="pro_ad_pic">
                <img src="{{PUB}}uploads/images/2016/ppt.png">
            </div>
            <div class="pro_ad_change">
                <div class="ppt_change_bg"></div>
                <ul class="ppt_change_pic">
                    <a href="##"><li><img src="{{PUB}}uploads/images/2016/ppt.png"></li></a>
                    <a href=""><li><img src="{{PUB}}uploads/images/2016/ppt2.png"></li></a>
                </ul>
            </div>
        </div>

        {{-- 一楼 --}}
        <div class="pro_floor">
            {{--标题列表--}}
            <div class="pro_big">
                <p>推荐的样片</p>
                <ul>
                    @if(count($recommends))
                        @foreach($recommends as $recommend)
                    <li><a href="{{DOMAIN}}product/{{ $recommend->id }}">{{ $recommend->name }}</a></li>
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
                    <div class="img"><img src="{{ $recommends[0]->getPicUrl() }}"></div>
                    <a href="{{DOMAIN}}product/{{ $recommend->id }}">{{ $recommends[0]->name }}</a>
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
                        <a href="{{DOMAIN}}product/{{ $recommend->id }}"><img src="{{ $recommend->getPicUrl() }}"></a>
                    </div>
                    <div class="text"><a href="{{DOMAIN}}product/{{ $recommend->id }}">{{ $recommend->name }}</a></div>
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
                @if(count($model->getNewests([])))
                    @foreach($model->getNewests([]) as $newest)
                <div class="img_text">
                    <div class="img">
                        <a href="{{DOMAIN}}product/{{ $newest->id }}"><img src="{{ $newest->getPicUrl() }}" style="@if($size=$newest->getPicSize($w=150,$h=125)) width:{{$size}}px; @endif height:125px;"></a>
                    </div>
                    <div class="text">
                        <a href="{{DOMAIN}}product/{{ $newest->id }}">{{ $newest->name }}</a>
                        <span style="color:red;float:right;">{{ $newest->click }}</span>
                    </div>
                </div>
                    @endforeach
                @endif
                @if(count($model->getNewests([]))<8)
                    @for($i=0;$i<8-count($model->getNewests([]));++$i)
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
                    @if(count($model->getNewests([2,4,5,6])))
                        @foreach($model->getNewests([2,4,5,6]) as $newest)
                    <div class="img_text">
                        {{--<div class="img_num"> 1 </div>--}}
                        <div class="img"><a href="{{DOMAIN}}product/{{ $newest->id }}">
                                <img src="{{ $newest->getPicUrl() }}" style="@if($size=$newest->getPicSize($w=150,$h=125)) width:{{$size}}px; @endif height:125px;"></a>
                        </div>
                        <a href="{{DOMAIN}}product/{{ $newest->id }}">{{ str_limit($newest->name,10) }}</a>
                        <a href="" class="click">点击<span>{{ $newest->click }}</span></a>
                    </div>
                        @endforeach
                    @endif
                    @if(count($model->getNewests([2,4,5,6]))<7)
                        @for($i=0;$i<7-count($model->getNewests([2,4,5,6]));++$i)
                    <div class="img_text">
                        {{--<div class="img_num"> 1 </div>--}}
                        <div class="img">
                            {{--<a href=""><div class="none">无</div></a>--}}
                        </div>
                        <a href="">无最新样片</a>
                        <a href="" class="click">点击<span>0</span></a>
                    </div>
                        @endfor
                    @endif
                </div>
            </div>
            {{-- 设计师信息 --}}
            <div class="pro_per">
                <div class="privateInfo">
                    <div class="title">个人</div>
                    @if(count($model->getNewests([1,3])))
                        @foreach($model->getNewests([1,3]) as $newest)
                    <div class="img_text">
                        {{--<div class="img_num"> 1 </div>--}}
                        <div class="img"><a href="{{DOMAIN}}product/{{ $newest->id }}"><img src="{{ $newest->getPicUrl() }}" style="@if($size=$newest->getPicSize($w=150,$h=125)) width:{{$size}}px; @endif height:125px;"></a></div>
                        <a href="{{DOMAIN}}product/{{ $newest->id }}">{{ str_limit($newest->name,10) }}</a>
                        <a href="" class="click">点击<span>{{ $newest->click }}</span></a>
                    </div>
                        @endforeach
                    @endif
                    @if(count($model->getNewests([1,3]))<7)
                        @for($i=0;$i<7-count($model->getNewests([1,3]));++$i)
                    <div class="img_text">
                        {{--<div class="img_num"> 1 </div>--}}
                        <div class="img">
                            {{--<a href=""><div class="none">无</div></a>--}}
                        </div>
                        <a href="">无最新样片</a>
                        <a href="" class="click">点击<span>0</span></a>
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
        <div class="pro_floor">
            <div class="title">宣传片</div>
            <div class=""></div>
        </div>
        <br style="clear:both;"><br>

        {{-- 广告片 --}}
        <div class="pro_floor">
            <div class="title">广告片</div>
            <div class=""></div>
        </div>
        <br style="clear:both;"><br>

        {{-- 微电影 --}}
        <div class="pro_floor">
            <div class="title">微电影</div>
            <div class=""></div>
        </div>
        <br style="clear:both;"><br>

        {{-- 汇报片 --}}
        <div class="pro_floor">
            <div class="title">汇报片</div>
            <div class=""></div>
        </div>
        <br style="clear:both;"><br>

        {{-- 晚会视频 --}}
        <div class="pro_floor">
            <div class="title">晚会视频</div>
            <div class=""></div>
        </div>
        <br style="clear:both;"><br>

        {{-- 淘宝视频 --}}
        <div class="pro_floor">
            <div class="title">淘宝视频</div>
            <div class=""></div>
        </div>
        <br style="clear:both;"><br>
    </div>
@stop