@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <style>
        a#pre { cursor:pointer; }
        a:hover#pre { color:red; }
        .play { box-shadow:0 0 100px black;position:fixed;left:30%;top:30%; }
        .play a#close { padding:10px;color:red;background:lightgrey;border-radius:10px;box-shadow:0 0 100px black;position:absolute;left:100%;top:0;z-index:10;cursor:pointer; }
        .play a:hover#close { color:white;background:red; }
    </style>

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

