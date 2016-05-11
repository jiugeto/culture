@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--@include('member.product.search')--}}
    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>产品名称</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->uname }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    @if($curr_list['url']=='')
                        <a href="/member/online/{{ $data->id }}" class="list_btn">预览</a>
                        <a href="/member/product/{{ $data->id }}" class="list_btn">查看</a>
                        <a href="/member/product/{{ $data->id }}/edit" class="list_btn">编辑</a>
                        <a href="/member/product/{{ $data->id }}/destroy" class="list_btn">删除</a>
                    @elseif($curr_list['url']=='trash')
                        <a href="/member/product/{{ $data->id }}/restore" class="list_btn">还原</a>
                        <a href="/member/product/{{ $data->id }}/forceDelete" class="list_btn">销毁记录</a>
                    @endif
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop