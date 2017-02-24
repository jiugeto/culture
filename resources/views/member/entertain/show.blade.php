@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td>娱乐名称：</td>
            <td>{{$data['title']}}</td>
        </tr>
        <tr>
            <td>供求关系：</td>
            <td>{{$data['genreName']}}</td>
        </tr>
        <tr>
            <td>简介：</td>
            <td>{{$data['intro']}}</td>
        </tr>
        <tr>
            <td>缩略图：</td>
            <td>
                @if($data['thumb'])<img src="{{$data['thumb']}}" width="300">
                @else /
                @endif
            </td>
        </tr>
        <tr>
            <td>艺人：</td>
            <td>{{$data['staffStr']}}</td>
        </tr>
        <tr>
            <td>作品：</td>
            <td>{{$data['workStr']}}</td>
        </tr>
        <tr>
            <td>发布者：</td>
            <td>{{$data['uname']}}</td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td>{{$data['createTime']}}</td>
        </tr>
        <tr>
            <td>更新时间：</td>
            <td>{{$data['updateTime']}}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

