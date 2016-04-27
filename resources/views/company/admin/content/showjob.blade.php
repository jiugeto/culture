@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{ $curr['name'] }}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width:100px;">序号：</td>
            <td>{{ $data->id }}</td>
        </tr>
        <tr>
            <td>分类名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td>父级id：</td>
            <td>{{ $data->pid }}</td>
        </tr>
        <tr>
            <td>介 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;绍：</td>
            <td>{{ $data->intro }}</td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td>更新时间：</td>
            <td>{{ $data->updated_at=='0000-00-00' ? '未更新' : $data->updated_at }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
            </td></tr>
    </table>
@stop

