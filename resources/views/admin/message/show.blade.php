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
                    <td>{{$data['id']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">消息标题 / Title：</td>
                    <td>{{$data['title']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">消息类型 / Genre：</td>
                    <td>{{$data['genreName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容 / Introduce：</td>
                    <td>{{$data['intro']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发送人 / Sender：</td>
                    <td>{{UserNameById($data['sender'])}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发送时间 / Sender Time：</td>
                    <td>{{$data['getSenderTime']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">接收人 / Accept：</td>
                    <td>{{UserNameById($data['accept'])}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发送时间 / Accept Time：</td>
                    <td>{{$data['getAcceptTime']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{$data['createTime']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">更新时间 / Update Time：</td>
                    <td>{{$data['updateTime']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only" colspan="2">
                        <button class="backbtn" onclick="history.go(-1)">
                            返 &nbsp;回</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop