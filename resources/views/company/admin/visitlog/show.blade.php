@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">用户名：</td>
                <td>{{ $data->getVisitName() }}</td>
            </tr>
            <tr>
                <td class="field_name">停留页面：</td>
                <td>{{ $data->getAction() }}</td>
            </tr>
            <tr>
                <td class="field_name">访问IP：</td>
                <td>{{ $data->ip }}</td>
            </tr>
            <tr>
                <td class="field_name">用户所在城市：</td>
                <td>{{ $data->ipaddress }}</td>
            </tr>
            <tr>
                <td class="field_name">当天访问次数：</td>
                <td>{{ $data->dayCount }} 次</td>
            </tr>
            <tr>
                <td class="field_name">当天访问时间：</td>
                <td>{{ $data->getTimeCount($visitRate) }}</td>
            </tr>
            <tr>
                <td class="field_name">容错值：</td>
                <td>{{ $data->dayCount * $visitRate }} 秒</td>
            </tr>
            <tr>
                <td class="field_name">首次访问时间：</td>
                <td>{{ $data->loginTime() }}</td>
            </tr>
            <tr>
                <td class="field_name">最后访问时间：</td>
                <td>{{ $data->logoutTime() }}</td>
            </tr>

            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp; 回</button></a>
                </td></tr>
        </table>
    </div>
@stop

