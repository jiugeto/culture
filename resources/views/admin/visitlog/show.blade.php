@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        @include('admin.common.menu')
    </div>
    <hr/>

    <div class="am-g">
        @include('admin.common.info')
        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                <tr>
                    <td class="am-hide-sm-only">编号 / Id：</td>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">访问的用户 / Name：</td>
                    <td>{{ $data->getVisitName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">访问的IP / IP：</td>
                    <td>{{ $data->ip }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">访问的城市 / Address：</td>
                    <td>{{ $data->ipaddress }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">被访问的企业 / Company Name：</td>
                    <td>{{ $data->getCName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">被访问的企页面 / View：</td>
                    <td>{{ $data->getAction() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">当天访问次数 / Day Count：</td>
                    <td>{{ $data->dayCount }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">当天访问时长 / Time Count：</td>
                    <td>{{ $data->getTimeCount() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">时长容错值 / Error Count：</td>
                    <td>{{ $data->dayCount * $data->getVisitRate().'秒' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">当天首次访问时间 / Login Time：</td>
                    <td>{{ $data->loginTime() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">当天最后访问时间 / Update Time：</td>
                    <td>{{ $data->logoutTime() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop