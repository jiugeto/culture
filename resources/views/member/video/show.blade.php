@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">视频名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td class="field_name">预览：</td>
            <td>
                <textarea cols="40" rows="5" disabled>地址：{{ $data->url.'?'.$data->url2 }}</textarea>
                <a title="点击预览" id="pre">点击预览</a>
            </td>
        </tr>
        <tr>
            <td class="field_name">视频宽度：(单位px)</td>
            <td>{{ $data->width }}</td>
        </tr>
        <tr>
            <td class="field_name">视频高度：(单位px)</td>
            <td>{{ $data->height }}</td>
        </tr>
        <tr>
            <td class="field_name">简介：</td>
            <td>{{ $data->intro ? $data->intro : '无' }}</td>
        </tr>
        <tr>
            <td class="field_name">创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updated_at!='0000-00-00 00:00:00' ? $data->updated_at : '未更新' }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
    @include('member.common.pre')
@stop

