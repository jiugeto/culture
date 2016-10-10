@extends('home.main')
@section('content')
    {{--@include('home.common.crumb')--}}
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> /
                <a href="{{DOMAIN}}opinion">用户心声</a> / 详情
            </div>
        </div>
    </div>

    <div class="show_con">
        <h3 class="center">用户心声详情页</h3>
        <table class="table_create table_show" cellspacing="0" cellpadding="0">
            <tr>
                <td width="100">心声标题：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td>用户名称：</td>
                <td>{{ $data->getUName() }}</td>
            </tr>
            <tr>
                <td>用户工作：</td>
                <td>{{ $data->work }}</td>
            </tr>
            <tr>
                <td>内容：</td>
                <td><div class="div_content">{{ $data->intro }}</div></td>
            </tr>
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

