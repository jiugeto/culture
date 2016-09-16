@extends('home.main')
@section('content')
    <div class="talk_con">
        <div class="talk_left">
            <div class="head">
                @if($curr=='')话题广场
                @elseif($curr=='follow')最新关注话题
                @elseif($curr=='mytalk')我的话题
                @elseif($curr=='collect')我收藏的话题
                @endif
            </div>

            @if(count($datas))
                @foreach($datas as $data)
            <table>
                <tr>
                    <td rowspan="3" class="img">
                        <div>
                            {{--<img src="{{PUB}}uploads/images/2016/online1.png">--}}
                            <div style="width:100px;height:100px;background:rgb(250,250,250);"></div>
                        </div>
                        <p>{{--数量--}}{{ $data->read }}</p>
                    </td>
                    <td class="small">话题来自 {{ $data->areatoname()  }}
                        @if($curr!=''))
                        <span class="right_close"><a href="{{DOMAIN}}talk/{{$data->id}}/destroy" title="删除此话题">×</a></span>
                        @endif
                        @if($curr!='mytalk' && $data->uid==Session::get('user.uid'))
                        <span class="right_close"><a href="{{DOMAIN}}talk/{{$data->id}}/edit" title="修改此话题">修改</a></span>
                        @endif
                    </td>
                </tr>
                <tr><td class="title"><a href="">话题名称：{{ $data->name }}</a></td></tr>
                <tr><td><b>发布人：{{ $data->getUName() }}</b></td></tr>
                <tr><td>&nbsp;</td><td class="con">{{ str_limit(strip_tags($data->content,100)) }}</td></tr>
                <tr><td>&nbsp;</td><td class="small">
                    @if($curr!='mytalk')
                        <a title="点击关注" onclick="window.location.href='{{DOMAIN}}talk/tofollow';">关注</a>：
                        {{ count($data->follow()) }} &nbsp;&nbsp;&nbsp;&nbsp;
                        {{--评论：&nbsp;&nbsp;&nbsp;&nbsp;--}}
                        <a title="点击感谢" onclick="window.location.href='{{DOMAIN}}talk/tothank';">感谢</a>：
                        {{ count($data->thank()) }} &nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击点赞" onclick="window.location.href='{{DOMAIN}}talk/toclick';">点赞</a>：
                        {{ count($data->click()) }} &nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击分享" onclick="window.location.href='{{DOMAIN}}talk/toshare';">分享</a>：
                        {{ count($data->share()) }} &nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击收藏" onclick="window.location.href='{{DOMAIN}}talk/toreport';">收藏</a>：
                        {{ count($data->collect()) }} &nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击举报" onclick="window.location.href='{{DOMAIN}}talk/tocollect';">举报</a>：
                        {{ count($data->report()) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @else
                        关注：{{ $data->follow() }} &nbsp;&nbsp;&nbsp;&nbsp;
                        {{--评论：&nbsp;&nbsp;&nbsp;&nbsp;--}}
                        感谢：{{ $data->thank() }} &nbsp;&nbsp;&nbsp;&nbsp;
                        点赞：{{ $data->click() }} &nbsp;&nbsp;&nbsp;&nbsp;
                        分享：{{ $data->share() }} &nbsp;&nbsp;&nbsp;&nbsp;
                        收藏：{{ $data->collect() }} &nbsp;&nbsp;&nbsp;&nbsp;
                        举报：{{ $data->report() }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif
                        发布时间：{{ date('Y年m月d日',$data->created_at) }}
                    </td></tr>
            </table>
                @endforeach
            @endif
            {{--@include('home.common.page')--}}
        </div>
        <div class="talk_right">
            <div class="theme">
                <a href="{{DOMAIN}}talk"><div class="{{$curr==''?'curr':''}}">话题广场</div></a>
                <a href="{{DOMAIN}}talk/mytalk"><div class="{{$curr=='mytalk'?'curr':''}}">我的话题</div></a>
                <a href="{{DOMAIN}}talk/follow"><div class="{{$curr=='follow'?'curr':''}}">我的关注</div></a>
                <a href="{{DOMAIN}}talk/collect"><div class="{{$curr=='collect'?'curr':''}}">我的收藏</div></a>
            </div>
            <div class="theme">
                <p class="title"><b>话题专栏</b></p>
                <a href="{{DOMAIN}}theme"><div class="{{$curr=='themelist'?'curr':''}}">专栏·发现</div></a>
                <a href="{{DOMAIN}}talk/create"><div>写话题</div></a>
            </div>
        </div>
    </div>
@stop