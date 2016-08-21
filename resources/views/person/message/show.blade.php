@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">消息详情</p>
            <h4 style="text-align:center;">消息详情</h4>
            <table class="tform">
                <tr>
                    <td>发送人：</td>
                    <td><div class="tshow">{{ $data->senderName() }}</div></td>
                </tr>
                <tr>
                    <td>接收人：</td>
                    <td><div class="tshow">{{ $data->acceptName() }}</div></td>
                </tr>
                <tr>
                    <td>标题：</td>
                    <td><div class="tshow">{{ $data->title }}</div></td>
                </tr>
                <tr>
                    <td>内容：</td>
                    <td>
                        <textarea readonly> &nbsp;{{ $data->intro }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>添加时间：</td>
                    <td><div class="tshow">{{ $data->createTime() }}</div></td>
                </tr>
                <tr>
                    <td>发送时间：</td>
                    <td><div class="tshow">{{ $data->senderTime() }}</div></td>
                </tr>
                <tr>
                    <td>消息状态：</td>
                    <td><div class="tshow">{{ $data->statusName() }}</div></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <a onclick="history.go(-1);">返回上一页</a>
                        @if($data->status==1)
                        <button type="button" class="companybtn"
                                onclick="window.location.href='{{DOMAIN}}person/message/send/{{ $data->id }}';">点击发送</button>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        @include('person.common.head')
    </div>
@stop