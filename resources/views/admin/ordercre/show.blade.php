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
                    <td>{{ $data['id'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">订单名称 / Name：</td>
                    <td>{{ $data['pname'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">订单号 / Serial：</td>
                    <td>{{ $data['serial'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类别 / Category：</td>
                    <td>{{ $data['cateName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">申请用户 / User Name：</td>
                    <td>{{ $data['uname'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">渲染格式 / Format：</td>
                    <td>{{ $data['formatName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">渲染价格 / Format Money：</td>
                    <td>{{ $data['formatMoney'] }} 元</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改意见 / Introduce：</td>
                    <td>{{ $data['record'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">总价格 / Money：</td>
                    <td>{{ $data['money2'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">所用福利 / Weal：</td>
                    <td>{{ $data['weal'] }} 元</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">需支付 / Real Money：</td>
                    <td>{{ $data['money2'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">状态 / Status：</td>
                    <td>{{ $data['statusName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">成品 / Video：</td>
                    <td><img src="{{ $data['thumb'] }}" width="200"></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台是否显示 / Is Show：</td>
                    <td>{{ $data['isShowName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data['createTime'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data['updateTime'] }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop