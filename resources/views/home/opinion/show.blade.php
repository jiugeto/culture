@extends('home.main')
@section('content')
    {{--@include('home.common.crumb')--}}
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="{{DOMAIN}}opinion">用户建议</a> / 详情
            </div>
        </div>
    </div>

    <div class="show_con">
        <h3 class="center">用户意见详情页</h3>
        <table class="table_create table_show" cellspacing="0" cellpadding="0">
            <tr>
                <td width="100">意见名称：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td>内容：</td>
                <td><div class="div_content">{!! $data->intro !!}</div></td>
            </tr>
            <tr>
                <td>用户名称：</td>
                <td>{{ $data->getUserName() }}</td>
            </tr>
            <tr>
                <td>意见状态：</td>
                <td>{{ $data->status() }}</td>
            </tr>
            {{--@if($data->remarks)--}}
            {{--<tr>--}}
                {{--<td>不满意缘由：</td>--}}
                {{--<td>{{ $data->remarks }}</td>--}}
            {{--</tr>--}}
            {{--@endif--}}
            {{--<tr>--}}
                {{--<td>是否回复：</td>--}}
                {{--<td>{{ $data->isreply==0 ? '无回复' : '有回复' }}</td>--}}
            {{--</tr>--}}
            {{--@if($data->isreply)--}}
            {{--<tr>--}}
                {{--<td>回复数量：</td>--}}
                {{--<td>{{ count($data->replyModels) }}</td>--}}
            {{--</tr>--}}
            {{--@endif--}}
            <tr>
                <td>发布时间：</td>
                <td>{{ $data->createTime() }}</td>
            </tr>
            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                    <button class="homebtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                </td></tr>
        </table>
    </div>
@stop

