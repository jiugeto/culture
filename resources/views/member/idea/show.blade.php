@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td>故事名称：</td>
            <td>{{$data['name']}}</td>
        </tr>
        <tr>
            <td>分类：</td>
            <td>{{$data['cateName']}}</td>
        </tr>
        <tr>
            <td>内容简介：</td>
            <td>{{$data['intro']}}</td>
        </tr>
        <tr>
            <td>估计(元)：</td>
            <td>{{$data['money']}}</td>
        </tr>
        <tr>
            <td>发布者：</td>
            <td>{{UserNameById($data['uid'])}}</td>
        </tr>
        <tr>
            <td>浏览次数：</td>
            <td>{{$data['read']}}</td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td>{{$data['createTime']}}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

