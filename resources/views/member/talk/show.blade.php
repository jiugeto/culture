@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">话题名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td class="field_name">所属主题：</td>
            <td>{{ $data->getThemeName() }}</td>
        </tr>
        <tr>
            <td class="field_name">内容：</td>
            <td>{!! $data->content !!}</td>
        </tr>
        <tr>
            <td class="field_name">发布人：</td>
            <td>{{ $data->getUserName() }}</td>
        </tr>
        <tr>
            <td class="field_name">阅读量：</td>
            <td>{{ $data->read }}</td>
        </tr>
        <tr>
            <td class="field_name">点击的用户：</td>
            <td>{{ $data->click() }}</td>
        </tr>
        <tr>
            <td class="field_name">收藏的用户：</td>
            <td>{{ $data->collect() }}</td>
        </tr>
        <tr>
            <td class="field_name">关注的用户：</td>
            <td>{{ $data->follow() }}</td>
        </tr>
        <tr>
            <td class="field_name">分享的用户：</td>
            <td>{{ $data->share() }}</td>
        </tr>
        <tr>
            <td class="field_name">感谢的用户：</td>
            <td>{{ $data->thank() }}</td>
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

