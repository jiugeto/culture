@extends('company.admin.main')
@section('content')
    <div class="com_admin_list">
        <h3 class="center pos">
            {{ $data->company() ? $data->company()->name : '某某公司' }}的{{ $lists['func']['name'] }}{{--详情页--}}
        </h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">公司logo：</td>
                <td><img src="{{ $data->logo }}" style="border:1px solid lightgrey;height:50px;"></td>
            </tr>
            <tr>
                <td class="field_name">鼠标移动显示：</td>
                <td>{{ $data->title }}</td>
            </tr>
            <tr>
                <td class="field_name">网站关键字：</td>
                <td>{{ $data->keyword }}</td>
            </tr>
            <tr>
                <td class="field_name">网站描述：</td>
                <td><div class="admin_show_con" style="height:100px;">{{ $data->description }}</div></td>
            </tr>

            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    <a href="/company/admin/basic/{{$data->id}}/edit">
                        <button class="companybtn">修&nbsp;&nbsp;改</button></a>
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop