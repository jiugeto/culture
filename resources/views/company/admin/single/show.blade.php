@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{$lists['func']['name']}}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">页面名称：</td>
                <td>{{$data['name']}}</td>
            </tr>
            <tr>
                <td class="field_name">所属模块：</td>
                <td>{{$data['moduleName']}}</td>
            </tr>
            <tr>
                <td class="field_name">内容：</td>
                <td>
                    <textarea cols="30" rows="10" class="textarea_show" readonly>{{$data['intro']}}</textarea>
                </td>
            </tr>
            <tr>
                <td class="field_name">创建时间：</td>
                <td>{{$data['createTime']}}</td>
            </tr>
            <tr>
                <td class="field_name">更新时间：</td>
                <td>{{$data['updateTime']}}</td>
            </tr>

            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    <button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button>
                </td></tr>
        </table>
    </div>
@stop

