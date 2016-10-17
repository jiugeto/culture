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
                    <td class="am-hide-sm-only">订单名称 / Name：</td>
                    <td>{{ $data->getProductName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">订单号 / Serial：</td>
                    <td>{{ $data->serial }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类型 / Genre：</td>
                    <td>{{ $data->getGenreName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类别 / Category：</td>
                    <td>{{ $data->getCateName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">申请用户 / User Name：</td>
                    <td>{{ $data->uname }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">供应方 / Seller Name：</td>
                    <td>{{ $data->getSellerName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">渲染格式 / Format：</td>
                    <td>{{ $data->getFormatName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">渲染价格 / Format Money：</td>
                    <td>{{ $data->getFormatMoney() }} 元</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改意见 / Introduce：</td>
                    <td>{{ $data->record }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">总价格 / Money：</td>
                    <td>{{ $data->getMoney() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">所用福利 / Weal：</td>
                    <td>{{ $data->getWeal() }} 元</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">需支付 / Real Money：</td>
                    <td>{{ $data->getRealMoney() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">状态 / Status：</td>
                    <td>{{ $data->getStatusName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">成品 / Video：</td>
                    <td>@if($data->status==5)<img src="{{ $data->getPicUrl() }}" width="200">@else / @endif</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台是否显示 / Is Show：</td>
                    <td>{{ $data->isshow() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->createTime() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updateTime() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop