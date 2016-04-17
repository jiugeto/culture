@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width:100px;">创意名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td>分类：</td>
            <td>{{ $data->cate_id }}</td>
        </tr>
        <tr>
            <td>内容：</td>
            <td>{!! $data->content !!}</td>
        </tr>
        <tr>
            <td>发布者：</td>
            <td>{{ $data->uid }}</td>
        </tr>
        <tr>
            <td>浏览次数：</td>
            <td>{{ $data->read }}</td>
        </tr>
        <tr>
            <td>点赞次数：</td>
            <td>{{ $data->click }}</td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

