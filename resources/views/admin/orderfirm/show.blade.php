@extends('admin.main')
@section('content')
<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户意见展示</strong> / <small>Opinion Detail</small></div>
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
                    <td class="am-hide-sm-only">服务名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">订单名称 / Order：</td>
                    <td>{{ $data->order() ? $data->order()->name : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类型 / Genre：</td>
                    <td>{{ $data->genreName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布方 / Seller：</td>
                    <td>{{ $data->sellerName }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">申请方 / Buyer：</td>
                    <td>{{ $data->buyerName }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">价格 / Money：</td>
                    <td>{{ $data->money }}元</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">状态 / Status：</td>
                    <td>{{ $data->status() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台显示否 / Is Show：</td>
                    <td>{{ $data->isshow ? '显示' : '不显示' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">删除否 / Del：</td>
                    <td>{{ $data->del ? '删除' : '不删除' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">更新时间 / Update Time：</td>
                    <td>{{ $data->updated_at ? $data->updated_at : '' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only" colspan="2">
                        <button class="backbtn" onclick="history.go(-1)">
                            返 &nbsp;&nbsp;&nbsp;回</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop