@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>订单名称</td>
                <td>订单类型</td>
                <td>申请人</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td><a href="{{DOMAIN}}member/order">{{$data['name']}}</a></td>
                <td>{{$data['genreName']}}</td>
                <td>{{$data['uname']}}</td>
                <td>{{$data['sellerName']}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    {{--@if($curr['url']=='')--}}
                        {{--<a href="{{DOMAIN}}member/order/{{ $data->id }}/pre" class="list_btn">预览</a>--}}
                        <a href="{{DOMAIN}}member/order/{{$data['id']}}" class="list_btn">查看</a>
                        {{--<a href="{{DOMAIN}}member/order/{{ $data->id }}/edit" class="list_btn">编辑</a>--}}
                        {{--<a href="{{DOMAIN}}member/order/{{ $data->id }}/destroy" class="list_btn">删除</a>--}}
                    {{--@elseif($curr['url']=='trash')--}}
                        {{--<a href="{{DOMAIN}}member/order/{{ $data->id }}/restore" class="list_btn">还原</a>--}}
                        {{--<a href="{{DOMAIN}}member/order/{{ $data->id }}/forceDelete" class="list_btn">销毁记录</a>--}}
                    {{--@endif--}}
                </td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop