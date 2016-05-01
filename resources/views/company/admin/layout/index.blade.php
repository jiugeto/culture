@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name" style="text-align:center;" colspan="2">
                    <b>功能页面设置</b>
                    &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td class="field_name">显示控制：</td>
                <td></td>
            </tr>
            <tr>
                <td class="field_name">顺序控制：</td>
                <td></td>
            </tr>
        </table>

        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name" style="text-align:center;" colspan="2">
                    <b>首页设置</b>
                    &nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td class="field_name">显示控制：</td>
                <td></td>
            </tr>
            <tr>
                <td class="field_name">顺序控制：</td>
                <td></td>
            </tr>
        </table>

        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/layout/{{$data->id}}/edit">--}}
                        {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

