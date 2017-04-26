@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="{{DOMAIN}}delivery">视频投放</a> / 详情
            </div>
        </div>
    </div>

    <div class="idea_show">
        <span class="idea_left">
            <p class="title"><b>{{$data['name']}}详情</b></p>
            <div class="idea_con">
                <table>
                    <tr>
                        <td>投放名称：</td>
                        <td style="width:550px;">{{$data['name']}}</td>
                    </tr>
                    <tr>
                        <td>类型：</td>
                        <td>{{$data['genreName']}}</td>
                    </tr>
                    <tr>
                        <td>商家：</td>
                        <td>{{ComNameByUid($data['uid'])}}</td>
                    </tr>
                    <tr>
                        <td>价格(元)：</td>
                        <td>{{$data['money']}}</td>
                    </tr>
                    <tr>
                        <td>介绍：</td>
                        <td>{{$data['intro']}}</td>
                    </tr>
                    <tr>
                        <td>有效期：</td>
                        <td>{{date('Y年m月d日 H:i:s',$data['fromtime'])}} -
                            {{date('Y年m月d日 H:i:s',$data['totime'])}}
                        </td>
                    </tr>
                    <tr>
                        <td>创建时间：</td>
                        <td>{{$data['createTime']}}</td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button class="homebtn"
                                    onclick="window.location.href='{{DOMAIN}}delivery';">
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