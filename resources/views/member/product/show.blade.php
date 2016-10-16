@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">产品名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td class="field_name">类型：</td>
            <td>{{ $data->genre() }}</td>
        </tr>
        <tr>
            <td class="field_name">类别：</td>
            <td>{{ $data->getCate() }}</td>
        </tr>
        <tr>
            <td class="field_name">简介：</td>
            <td>{{ $data->intro ? $data->intro : '无' }}</td>
        </tr>
        <tr>
            <td class="field_name">缩略图：</td>
            <td><a href="{{DOMAIN}}online/pre/{{ $data->id }}" target="_blank" title="点击预览">
                    <img src="{{ $data->getPicUrl() }}" width="400"></a>
            </td>
        </tr>
        <tr>
            <td class="field_name">创建时间：</td>
            <td>{{ $data->createTime() }}</td>
        </tr>
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updateTime() }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

