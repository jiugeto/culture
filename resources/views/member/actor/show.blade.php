@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td>演员艺名：</td>
            <td>{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td>真实姓名：</td>
            <td>{{ $data['realname'] }}</td>
        </tr>
        <tr>
            <td>性别：</td>
            <td>{{ $data['sexName'] }}</td>
        </tr>
        <tr>
            <td>家庭地址：</td>
            <td>{{ $data['origin'] }}</td>
        </tr>
        <tr>
            <td>学历：</td>
            <td>{{ $data['eduName'] }}</td>
        </tr>
        <tr>
            <td>毕业学校：</td>
            <td>{{ $data['school'] }}</td>
        </tr>
        <tr>
            <td>兴趣爱好：</td>
            <td>{{$data['hobbyName']}}</td>
        </tr>
        <tr>
            <td>身高：</td>
            <td>{{ $data['height'] }} cm</td>
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
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
            </td></tr>
    </table>
@stop

