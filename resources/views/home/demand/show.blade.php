@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="{{DOMAIN}}demand/{{$genre==1?'':'s/'.$genre}}">
                    {{$genreName}}频道
                </a> / 详情
            </div>
        </div>
    </div>

    <div class="idea_show">
        <span class="idea_left">
            <p class="title"><b>{{$data['name']}}详情</b></p>
            <div class="idea_con">
                <table>
                    <tr>
                        <td>{{$genreName}}名称：</td>
                        <td style="width:550px;">{{$data['name']}}</td>
                    </tr>
                @if($genre==1)
                @elseif($genre==2)
                @elseif($genre==3)
                @else
                @endif
                    <tr>
                        <td>创建时间：</td>
                        <td>{{$data['createTime']}}</td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button class="homebtn"
                                    onclick="window.location.href='{{DOMAIN}}demand/{{$genre==1?'':'s/'.$genre}}';">
                                返 &nbsp;回</button>
                        </td>
                    </tr>
                </table>
            </div>
        </span>
        {{--发布方信息--}}
        @include('home.common.userinfo')
    </div>
@stop