@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <h3 class="center">{{$menus['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width:100px;">娱乐名称：</td>
            <td>{{ $data->title }}</td>
        </tr>
        <tr>
            <td>供求关系：</td>
            <td>{{ $data->genre==1 ? '供应' : '需求' }}</td>
        </tr>
        <tr>
            <td>简 &nbsp;介：</td>
            <td>{{ $data->content }}</td>
        </tr>
        <tr>
            <td>发布者：</td>
            <td>{{ $data->uid }}</td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td>更新时间：</td>
            <td>{{ $data->updated_at ? '未更新' : $data->updated_at }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

