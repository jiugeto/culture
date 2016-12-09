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
                    <td>{{ $data['id'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">意见名称 / Name：</td>
                    <td>{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容 / Content：</td>
                    <td><div class="div_content">{!! $data['intro'] !!}</div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名称 / User Id：</td>
                    <td>{{ $data['username'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">意见状态 / Status：</td>
                    <td>{{ $data['statusName'] }}</td>
                </tr>
                {{--@if($data->remarks)--}}
                <tr>
                    <td class="am-hide-sm-only">不满意缘由 / Remarks：</td>
                    <td>{{ $data['remarks'] }}</td>
                </tr>
                {{--@endif--}}
                <tr>
                    <td class="am-hide-sm-only">前台是否显示 / Is Show：</td>
                    <td>{{ $data['isShowName'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data['createTime'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">更新时间 / Update Time：</td>
                    <td>{{ $data['updateTime'] }}</td>
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