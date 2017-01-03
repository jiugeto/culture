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
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td>内容：</td>
                <td><div class="div_content">{!! $data['intro'] !!}</div></td>
            </tr>
            <tr>
                <td>用户名称：</td>
                <td>{{ $data['username'] }}</td>
            </tr>
            <tr>
                <td>意见状态：</td>
                <td>{{ $data['statusName'] }}</td>
            </tr>
            @if($data['status']==4)
            <tr>
                <td>留言：</td>
                <td>{!! $data['remarks'] !!}</td>
            </tr>
            @endif
            <tr>
                <td>发布时间：</td>
                <td>{{ $data['createTime'] }}</td>
            </tr>
            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                    <button class="homebtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                </td></tr>
        </table>
    </div>
@stop

