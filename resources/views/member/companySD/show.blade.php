@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{ $lists['func']['name'] }}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width:100px;">作品名称：</td>
            <td>{{ $data->name }}</td>
        </tr>

        <tr>
            <td>类 &nbsp;型：</td>
            <td>{{ $data->type() }}</td>
        </tr>

        <tr>
            <td>分 &nbsp;类：</td>
            <td>{{ $data->getCate() }}</td>
        </tr>

        <tr>
            <td>介 &nbsp;绍：</td>
            <td>{{ $data->intro }}</td>
        </tr>

        <tr>
            <td>文件链接：</td>
            <td>{{ $data->getVideoUrl() }}</td>
        </tr>

        <tr>
            <td>用户名称：</td>
            <td>{{ $data->getUserName() }}</td>
        </tr>

        <tr>
            <td>创建时间：</td>
            <td>{{ $data->createTime() }}</td>
        </tr>

        <tr>
            <td>更新时间：</td>
            <td>{{ $data->updateTime() }}</td>
        </tr>

        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

