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
                    <td class="am-hide-sm-only">意见名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容 / Content：</td>
                    <td><div class="div_content">{!! $data->intro !!}</div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">图片 / Picture：</td>
                    <td><img src="{{ $data->pic }}"></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名称 / User Id：</td>
                    <td>{{ $data->uid }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">意见状态 / Status：</td>
                    <td>{{ $data->status() }}</td>
                </tr>
                {{--@if($data->remarks)--}}
                <tr>
                    <td class="am-hide-sm-only">不满意缘由 / Remarks：</td>
                    <td>{{ $data->remarks }}</td>
                </tr>
                {{--@endif--}}
                <tr>
                    <td class="am-hide-sm-only">是否回复 / Is Reply：</td>
                    <td>{{ $data->isreply==0 ? '无回复' : '有回复' }}</td>
                </tr>
                {{--@if($data->isreply)--}}
                <tr>
                    <td class="am-hide-sm-only">回复数量 Reply Number：</td>
                    <td>{{ $data->replyModels() ? count($data->replyModels()) : 0 }}</td>
                </tr>
                {{--@endif--}}
                <tr>
                    <td class="am-hide-sm-only">前台是否显示 / Is Show：</td>
                    <td>{{ $data->isshow==0 ? '不显示' : '显示' }}</td>
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