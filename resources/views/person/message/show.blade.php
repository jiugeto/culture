@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:750px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">消息详情</p>
            <div class="list" style="width:748px;">
                <h4 style="text-align:center;">消息详情</h4>
                <table class="tform">
                    <tr>
                        <td>发送人：</td>
                        <td><div class="tshow">{{UserNameById($data['sender'])}}</div></td>
                    </tr>
                    <tr>
                        <td>接收人：</td>
                        <td><div class="tshow">{{UserNameById($data['accept'])}}</div></td>
                    </tr>
                    <tr>
                        <td>标题：</td>
                        <td><div class="tshow">{{$data['title']}}</div></td>
                    </tr>
                    <tr>
                        <td>内容：</td>
                        <td><textarea readonly style="border:1px solid ghostwhite;outline:none;">
                                {{$data['intro']}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>添加时间：</td>
                        <td><div class="tshow">{{$data['createTime']}}</div></td>
                    </tr>
                    <tr>
                        <td>发送时间：</td>
                        <td><div class="tshow">{{$data['getSenderTime']}}</div></td>
                    </tr>
                    <tr>
                        <td>消息状态：</td>
                        <td><div class="tshow">{{$data['statusName']}}</div></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <a onclick="history.go(-1);">返回上一页</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop