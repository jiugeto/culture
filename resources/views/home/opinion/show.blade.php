@extends('home.main')
@section('content')
    @include('home.common.crumb')

    <div class="show_con">
        <h3 class="center">{{ $menus[$curr] }}详情页</h3>
        <table class="table_create table_show" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width:100px;">序号：</td>
                <td>{{ $data->id }}</td>
            </tr>
            <tr>
                <td>意见名称：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td>内容：</td>
                <td><div class="div_content">{!! $data->intro !!}</div></td>
            </tr>
            <tr>
                <td>图片：</td>
                <td><img src="{{ $data->pic }}"></td>
            </tr>
            <tr>
                <td>用户名称：</td>
                <td>{{ $data->uid }}</td>
            </tr>
            <tr>
                <td>意见状态：</td>
                <td>{{ $data->status() }}</td>
            </tr>
            @if($data->remarks)
            <tr>
                <td>不满意缘由：</td>
                <td>{{ $data->remarks }}</td>
            </tr>
            @endif
            @if($data->reply_id)
            <tr>
                <td>不满意缘由：</td>
                <td>{{ $data->remarks }}</td>
            </tr>
            @endif
            <tr>
                <td>创建时间：</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                    <button class="homebtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                </td></tr>
        </table>
    </div>
@stop

