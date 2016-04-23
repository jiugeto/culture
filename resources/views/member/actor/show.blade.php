@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width:100px;">序号：</td>
            <td>{{ $data->id }}</td>
        </tr>
        <tr>
            <td>演员艺名：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td>真实姓名：</td>
            <td>{{ $data->realname }}</td>
        </tr>
        <tr>
            <td>性别：</td>
            <td>{{ $data->sex==1 ? '男' : '女' }}</td>
        </tr>
        <tr>
            <td>家庭地址：</td>
            <td>{{ $data->origin }}</td>
        </tr>
        <tr>
            <td>学历：</td>
            <td>{{ $educations[$data->education] }}</td>
        </tr>
        <tr>
            <td>毕业学校：</td>
            <td>{{ $data->school }}</td>
        </tr>
        <tr>
            <td>兴趣爱好：</td>
            <td>{{ $data->hobby }}</td>
        </tr>
        <tr>
            <td>身高：</td>
            <td>{{ $data->height }} cm</td>
        </tr>
        <tr>
            <td>职务：</td>
            <td>{{ $data->job }}</td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td>更新时间：</td>
            <td>{{ $data->updated_at ? $data->updated_at : '未更新' }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
            </td></tr>
    </table>
@stop

