@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--@include('member.product.search')--}}
    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <style>
        a.look { padding:2px 5px;background:white; }
        a:hover.look { background:lightgrey; }
    </style>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>产品名称</td>
                <td>属性</td>
                <td>图文</td>
                <td>动画</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ count($data->attrs()) ? count($data->attrs()) : 0 }}
                    <a href="/member/attrs" class="star look" title="点击查看该产品属性列表">细看</a>
                </td>
                <td>{{ count($data->cons()) ? count($data->cons()) : 0 }}
                    <a href="/member/cons" class="star look" title="点击查看该产品内容列表">细看</a>
                </td>
                <td>{{ count($data->layers()) ? count($data->layers()) : 0 }}
                    <a href="/member/layers" class="star look" title="点击查看该产品动画列表">细看</a>
                </td>
                <td>{{ $data->uname }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    @if($curr['url']=='')
                        <a href="/member/online/{{ $data->id }}" class="list_btn">预览</a>
                        <a href="/member/product/{{ $data->id }}" class="list_btn">查看</a>
                        <div style="height:10px;"></div>
                        <a href="/member/product/{{ $data->id }}/edit" class="list_btn">编辑</a>
                        <a href="/member/product/{{ $data->id }}/destroy" class="list_btn">删除</a>
                    @elseif($curr['url']=='trash')
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