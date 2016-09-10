@extends('company.main')
@section('content')
    @if($layoutHomeSwitchs['pptSwitch'])
    <div class="com_ppt">
        <div class="com_ad">
            @if(count($ppts))
                @foreach($ppts as $kppt=>$ppt)
                <a href="{{ $ppt->link }}" title="{{ $ppt->name }}">
                    <div class="img" id="ppt_{{$ppt->id}}"><img src="{{ $ppt->getPicUrl() }}"></div>
                </a>
                @endforeach
            @endif

            @if(count($ppts)<$ppts->limit)
                @for($i=0;$i<$ppts->limit-count($ppts);++$i)
                <div class="img" id="ppt_{{$i}}">广告待添加 {{$i+1}}
                    {{--<img src="{{DOMAIN}}uploads/images/2016/ppt.png">--}}
                </div>
                @endfor
            @endif
        </div>
        <div class="com_ppt_point">
            <ul style="width:{{$ppts->limit/10*400}}px;">
            @if(count($ppts)<$ppts->limit)
                @for($i=0;$i<$ppts->limit-count($ppts);++$i)
                    <li class="{{ $i==0?'li_curr':'' }}" id="li_{{$i}}" onmouseover="move({{$i}})"></li>
                @endfor
            @endif
            </ul>
        </div>
        <script>
            function move(i){
                $(".com_ppt_point > ul li").removeClass('li_curr'); $("#li_"+i).addClass('li_curr');
                $(".com_ad > div.img").hide(); $("#ppt_"+i).show();
            }
        </script>
    </div>
    @endif

    @if($layoutHomeSwitchs['serviceSwitch'])
    <div class="fengexian">{{--分割线--}}</div>
    <div class="com_floor1">
        <p class="bigtitle">→ OUR SERVICE 服务项目 <span class="float_right"><a href="{{DOMAIN}}c/{{CID}}/firm">更多</a></span></p>
        <div class="com_floor">
            @if(count($firms))
            @foreach($firms as $kfirm=>$firm)
                <div class="serve" style="{{$kfirm>3?"margin-top:20px;":""}}">
                    <p class="title">{{ $firm->name }}</p>
                    @if($firm->pic_id)
                        <p class="img"><img src="{{ $firm->pic()->url }}"></p>
                    @else
                        <p class="img">图片待添加</p>
                    @endif
                    <p>{{ strip_tags($firm->intro) }}</p>
                </div>
            @endforeach
            @endif
            @if(count($firms)<$infos->limit)
                @for($i=0;$i<$firms->limit-count($firms);++$i)
                <div class="serve">
                    <p class="title">服务名称 待添加</p>
                    <p class="img">图片待添加</p>
                    <p>服务的内容介绍 待添加</p>
                </div>
                @endfor
            @endif
        </div>
    </div>
    @endif

    @if($layoutHomeSwitchs['newsSwitch'])
    <div class="fengexian">{{--分割线--}}</div>
    <div class="com_floor2">
        <p class="bigtitle">→ OUR NEWS 新闻资讯 <span class="float_right"><a href="{{DOMAIN}}c/{{CID}}/about/3">更多</a></span></p>
        <div class="com_floor">
            {{--图片是最新的新闻显示--}}
            <div class="com_news">
                @if(count($news))
                    @foreach($news as $new)
                <div class="img">
                    @if($new->pic_id)
                        <img src="{{ $new->getPicUrl() }}"
                             style="@if($size=$new->getUserPicSize($new->pic(),$w=210,$h=200))width:{{$size}}px;height:200px; @endif">
                    @else 待添加
                    @endif
                </div>
                    @endforeach
                @else <div class="img">待添加</div>
                @endif
            </div>
            <div class="com_news_text">
                <p class="title">公司新闻</p>
                @if(count($news))
                @foreach($news as $new)
                    <p>
                        <a href="">{{ $new->name }}</a>
                        <span class="time">{{ $new->createTime() }}</span>
                    </p>
                @endforeach
                @endif
                @if(count($news)<$news->limit)
                    @for($i=0;$i<$news->limit-count($news);++$i)
                        <p>企业新闻 待添加
                            <span class="time">某年某月某日</span>
                        </p>
                    @endfor
                @endif
            </div>
            <div class="trade_news">
                <p class="title">行业资讯</p>
                @if(count($infos))
                @foreach($infos as $info)
                    <p>
                        <a href="">{{ $info->name }}</a>
                        <span class="time">{{ $info->createTime() }}</span>
                    </p>
                @endforeach
                @endif
                @if(count($infos)<$infos->limit)
                    @for($i=0;$i<$infos->limit-count($infos);++$i)
                        <p>行业资讯 待添加
                            <span class="time">某年某月某日</span>
                        </p>
                    @endfor
                @endif
            </div>
        </div>
    </div>
    @endif

    @if($layoutHomeSwitchs['productSwitch'])
    <div class="fengexian">{{--分割线--}}</div>
    <div class="com_floor3">
        <p class="bigtitle">→ OUR PRODUCT 公司作品 <span class="float_right"><a href="{{DOMAIN}}c/{{CID}}/product">更多</a></span></p>
        <div class="com_product">
            {{--<div class="com_tab">--}}
                {{--<a>影视广告</a>--}}
                {{--<a>微电影</a>--}}
                {{--<a>宣传片</a>--}}
            {{--</div>--}}
            <div class="com_con">
                @if(count($works))
                    @foreach($works as $kwork=>$work)
                <a href="" title="{{ $work->name }}">
                    <div class="com_pro" style="{{$kwork>3?"margin-top:20px;":""}}">
                        <div class="img">
                            <img src="{{ $work->getPicUrl() }}"
                                 style="@if($size=$work->getPicSize($w=240,$h=140))width:{{$size}}px;height:140px @endif">
                        </div>
                        <p class="text pname">{{ $work->name }}</p>
                    </div>
                </a>
                    @endforeach
                @endif
                @if(count($works)<$works->limit)
                    @for($i=0;$i<$works->limit-count($works);++$i)
                <a href="" title="">
                    <div class="com_pro">
                        <div class="img">待添加</div>
                        <p class="text pname">视频作品 待添加</p>
                    </div>
                </a>
                    @endfor
                @endif
            </div>
        </div>
    </div>
    @endif

    @if($layoutHomeSwitchs['parternerSwitch'])
    <div class="fengexian">{{--分割线--}}</div>
    <div class="com_floor4">
        <p class="bigtitle">→ OUR PARTERNERS 合作伙伴 <span class="float_right"><a href="{{DOMAIN}}c/{{CID}}/parterner">更多</a></span></p>
        <div class="com_parterner">
            @if(count($parterners))
                @foreach($parterners as $parterner)
            <a href="" title="{{ $parterner->name }}">
                <div class="com_par">
                    <div class="img"><img src="{{ $parterner->getPicUrl() }}"></div>
                </div>
            </a>
                @endforeach
            @endif
            @if(count($parterners)<$parterners->limit)
                @for($i=0;$i<$parterners->limit-count($parterners);++$i)
            <a href="">
                <div class="com_par">
                    <div class="img">待添加</div>
                </div>
            </a>
                @endfor
            @endif
        </div>
    </div>
    @endif

    @if($layoutHomeSwitchs['footLinkSwitch'])
    <div class="fengexian">{{--分割线--}}</div>
    <div class="com_buttom">
        <div class="foot">
            @if(count($footlinks))
                @foreach($footlinks as $footlink)
            <a href="{{ $footlink->link }}">{{ $footlink->name }}</a>
                @endforeach
            @endif
            @if(count($footlinks)<$footlinks->limit)
                @for($i=0;$i<$footlinks->limit-count($footlinks);++$i)
            <a href="">待添加链接</a>
                @endfor
            @endif
        </div>
    </div>
    @endif
@stop