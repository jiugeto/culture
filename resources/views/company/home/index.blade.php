@extends('company.main')
@section('content')
    <div class="com_ppt">
        <div class="com_ad">
            @if(count($ppts))
            @foreach($ppts as $ppt)
                <div class="ppt_img">
                    <a href="{{ $ppt->link }}">
                        <div class="img"><img src="{{ $ppt->getPicUrl() }}"></div>
                    </a>
                    <a href="{{ $ppt->link }}">
                        <div class="img"><img src="{{ $ppt->getPicUrl() }}"></div>
                    </a>
                </div>
            @endforeach
            @else
                <div class="ppt_img">
                    {{--<a href="{{ $ppt->link }}">--}}
                        <div class="img"><img src="{{DOMAIN}}uploads/images/2016/ppt.png"></div>
                    {{--</a>--}}
                </div>
            @endif
        </div>
        <div class="com_ppt_point">
            <ul>
                {{--@if(count($ppts))--}}
                {{--@foreach($ppts as $ppt)--}}
                {{--<li class="li_curr"></li>--}}
                {{--@endforeach--}}
                {{--@endif--}}
                @if(count($ppts)<$ppts->limit)
                    @for($i=0;$i<$ppts->limit-count($ppts);++$i)
                        <li class="{{ $i==0?'li_curr':'' }}"></li>
                    @endfor
                @endif
            </ul>
        </div>
    </div>

    <div class="com_floor1">
        <hr>
        <p>→ OUR SERVICE 服务项目 <span class="float_right"><a href="">详情</a></span></p>
        <div class="com_floor">
            @foreach($firms as $firm)
            <span class="service">
                <div class="serve">
                    <p class="title">{{ $firm->name }}</p>
                    <p>{{ strip_tags($firm->intro) }}</p>
                </div>
            </span>
            @endforeach
        </div>
    </div>

    <div class="com_floor2">
        <br><hr>
        <p>→ OUR NEWS 新闻咨询 <span class="float_right"><a href="">更多</a></span></p>
        <div class="com_floor">
            <div class="com_news">
                <div><img src="/uploads/images/2016/ppt.png"></div>
            </div>
            <div class="com_news_text">
                <p class="title">公司新闻</p>
                @foreach($news as $new)
                    @if($new->type==7)
                    <p>{{ $new->name }}
                        <span style="float:right;">{{ $new->created_at }}</span>
                    </p>
                    @endif
                @endforeach
            </div>
            <div class="trade_news">
                <p class="title">行业资讯</p>
                @foreach($news as $new)
                    @if($new->type==8)
                    <p>{{ $new->name }}
                        <span style="float:right;">{{ $new->created_at }}</span>
                    </p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="com_floor3">
        <br><hr>
        <p>→ OUR PRODUCT 某某产品 <span class="float_right"><a href="">更多</a></span></p>
        <div class="com_product">
            <div class="com_tab">
                <a>影视广告</a>
                <a>微电影</a>
                <a>宣传片</a>
            </div>
            <div class="com_con">
                <span class="onlyone">
                    <div class="com_pro">
                        <div><img src="/uploads/images/2016/online1.png"></div>
                        <p>rgtnhj</p>
                    </div>
                </span>
                <span class="onlyone">
                    <div class="com_pro">
                        <div><img src="/uploads/images/2016/online1.png"></div>
                        <p>rgtnhj</p>
                    </div>
                </span>
                <span class="onlyone">
                    <div class="com_pro">
                        <div><img src="/uploads/images/2016/online1.png"></div>
                        <p>rgtnhj</p>
                    </div>
                </span>
                <span class="onlyone">
                    <div class="com_pro">
                        <div><img src="/uploads/images/2016/online1.png"></div>
                        <p>rgtnhj</p>
                    </div>
                </span>
            </div>
        </div>
    </div>

    <div class="com_floor3">
        <br><hr>
        <p>→ OUR PARTERNERS 某某合作伙伴 <span class="float_right"><a href="">更多</a></span></p>
        <div class="com_parterner">
            <span class="onlyone">
                <div class="com_par">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </span>
            <span class="onlyone">
                <div class="com_par">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </span>
            <span class="onlyone">
                <div class="com_par">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </span>
            <span class="onlyone">
                <div class="com_par">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </span>
            <span class="onlyone">
                <div class="com_par">
                    <div><img src="/uploads/images/2016/online1.png"></div>
                </div>
            </span>
        </div>
    </div>

    <div class="com_buttom">
        <p><a href="">脚部链接</a></p>
    </div>
@stop