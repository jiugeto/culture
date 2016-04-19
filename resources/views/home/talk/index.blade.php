@extends('home.main')
@section('content')
    <div class="talk_con">
        <div class="talk_left">
            <div class="head">最新话题</div>
            {{--<table>--}}
                {{--<tr>--}}
                    {{--<td rowspan="3" class="img">--}}
                        {{--<div><img src="/uploads/images/2016/online1.png"></div>--}}
                        {{--<p>数量</p>--}}
                    {{--</td>--}}
                    {{--<td class="small">话题来自--}}
                        {{--<span class="right"><a href="" title="删除此话题">×</a></span>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr><td class="title">话题名称：</td></tr>--}}
                {{--<tr><td><b>发布人：</b></td></tr>--}}
                {{--<tr><td>&nbsp;</td><td>--}}
                        {{--内容：如果方便热播后共同日本如果方便热播后共同日本如果方便热播后共同日本如果方便热播后共同日本如果方便热播后共同日本如果方便热播后共同日本如果方便热播后共同日本--}}
                    {{--</td></tr>--}}
                {{--<tr><td>&nbsp;</td><td class="small">--}}
                        {{--关注话题：&nbsp;&nbsp;&nbsp;&nbsp;--}}
                        {{--评论：&nbsp;&nbsp;&nbsp;&nbsp;--}}
                        {{--感谢：&nbsp;&nbsp;&nbsp;&nbsp;--}}
                        {{--分享：&nbsp;&nbsp;&nbsp;&nbsp;--}}
                        {{--收藏：&nbsp;&nbsp;&nbsp;&nbsp;--}}
                        {{--举报：&nbsp;&nbsp;&nbsp;&nbsp;--}}
                    {{--</td></tr>--}}
            {{--</table>--}}
            @if($datas->total())
                @foreach($datas as $data)
            <table>
                <tr>
                    <td rowspan="3" class="img">
                        <div><img src="/uploads/images/2016/online1.png"></div>
                        <p>{{--数量--}}{{ $data->read }}</p>
                    </td>
                    <td class="small">话题来自
                        <span class="right"><a href="/talk/{{$data->id}}/destroy" title="删除此话题">×</a></span>
                    </td>
                </tr>
                <tr><td class="title">话题名称：{{ $data->name }}</td></tr>
                <tr><td><b>发布人：{{ $data->uid }}</b></td></tr>
                <tr><td>&nbsp;</td><td>{{ $data->content }}</td></tr>
                <tr><td>&nbsp;</td><td class="small">
                        <a title="点击关注" onclick="window.location.href='';">关注此话题</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        评论：&nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击感谢" onclick="window.location.href='';">感谢</a>：{{ $data->thank }}&nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击点赞" onclick="window.location.href='';">点赞</a>：{{ $data->click }}&nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击分享" onclick="window.location.href='';">分享</a>：{{ $data->share }}&nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击收藏" onclick="window.location.href='';">收藏</a>：{{ $data->collect }}&nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="点击举报" onclick="window.location.href='';">举报</a>：{{ $data->report }}&nbsp;&nbsp;&nbsp;&nbsp;
                        时间：{{ $data->created_at }}
                    </td></tr>
            </table>
                @endforeach
            @endif
        </div>
        <div class="talk_right">
            <div class="theme">
                {{--<p>我的关注</p>--}}
                <a href=""><div>我的关注</div></a>
                <a href=""><div>我的收藏</div></a>
            </div>
            <div class="theme">
                <p class="title"><b>话题专栏</b></p>
                <a href=""><div>专栏·发现</div></a>
                <a href=""><div>写话题</div></a>
            </div>
        </div>
    </div>
@stop