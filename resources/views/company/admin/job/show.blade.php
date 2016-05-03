@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">招聘名称：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td class="field_name">简单介绍：</td>
                <td><div class="admin_show_con">{{ $data->intro }}</div></td>
            </tr>
            <tr>
                <td class="field_name">岗位名称：</td>
                <td>{{ $data->job }}</td>
            </tr>
            <tr>
                <td class="field_name">岗位人数：</td>
                <td>{{ $data->num }}</td>
            </tr>
            <tr>
                <td class="field_name">岗位要求：</td>
                <td><div class="admin_show_con">{{ $data->require }}</div></td>
            </tr>
            <tr>
                <td class="field_name">是否置顶：</td>
                <td>{{ $data->istop2 ? '置顶' : '不置顶' }}</td>
            </tr>
            <tr>
                <td class="field_name">排序：</td>
                <td>{{ $data->sort2 }}</td>
            </tr>
            <tr>
                <td class="field_name">前台显示否：</td>
                <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
            </tr>

            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/job/{{$data->id}}/edit">--}}
                        {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

