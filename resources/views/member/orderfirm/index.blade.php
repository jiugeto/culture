@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--<div class="mem_tab">@include('member.common.lists')</div>--}}
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>售后名称</td>
                <td>订单名称</td>
                <td>申请方</td>
                <td>发布方</td>
                <td>价格</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td><a href="/member/orderfirm">{{ $data->name }}</a></td>
                <td>{{ $data->order() ? $data->order()->name : '无' }}</td>
                <td>{{ $data->buyerName }}</td>
                <td>{{ $data->sellerName }}</td>
                <td>{{ $data->money }}元</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    {{--@if($curr['url']=='')--}}
                        {{--<a href="/member/orderfirm/{{ $data->id }}/pre" class="list_btn">预览</a>--}}
                        <a href="/member/orderfirm/{{ $data->id }}" class="list_btn">查看</a>
                        {{--<a href="/member/orderfirm/{{ $data->id }}/edit" class="list_btn">编辑</a>--}}
                        {{--<a href="/member/orderfirm/{{ $data->id }}/destroy" class="list_btn">删除</a>--}}
                    {{--@elseif($curr['url']=='trash')--}}
                        {{--<a href="/member/orderfirm/{{ $data->id }}/restore" class="list_btn">还原</a>--}}
                        {{--<a href="/member/orderfirm/{{ $data->id }}/forceDelete" class="list_btn">销毁记录</a>--}}
                    {{--@endif--}}
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop