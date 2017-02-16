@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td>设备名称：</td>
            <td>{{ $data['name'] }}</td>
        </tr>

        <tr>
            <td>供求关系：</td>
            <td>{{ $data['genreName'] }}</td>
        </tr>

        <tr>
            <td>设备类型：</td>
            <td>{{ $data['typeName'] }}</td>
        </tr>

        <tr>
            <td>简 &nbsp;介：</td>
            <td>{{ $data['intro'] }}</td>
        </tr>

        <tr>
            <td>发布者：</td>
            <td>{{ UserNameById($data['uid']) }}</td>
        </tr>

        <tr>
            <td>价 &nbsp;格(元)：</td>
            <td>{{ $data['money'] }}</td>
        </tr>

        <tr>
            <td>创建时间：</td>
            <td>{{ $data['createTime'] }}</td>
        </tr>

        <tr>
            <td>更新时间：</td>
            <td>{{ $data['updateTime'] }}</td>
        </tr>

        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

