@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--@include('member.product.search')--}}
    {{--<div class="mem_tab">@include('member.common.lists')</div>--}}
    <div class="mem_tab">
        <ul>
            <a href="/member/productlayer"><li>返回产品动画列表</li></a>
            <li class="star">&nbsp;&nbsp;此为{{ $layerModel->name }}的属性动画</li>
        </ul>
    </div>
    <div class="mem_create"><a href="/member/{{$layerModel->id}}/prolayerattr/create">添加属性动画</a></div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai"></div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>动画名称</td>
                <td>产品名称</td>
                <td>属性名称</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->layer() }}</td>
                <td>{{ $data->product() }}</td>
                <td>{{ $data->attrname() }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    @if($curr['url']=='')
                        <a href="/member/{{$layerModel->id}}/prolayerattr/{{ $data->id }}" class="list_btn">查看</a>
                        <a href="/member/{{$layerModel->id}}/prolayerattr/{{ $data->id }}/edit" class="list_btn">编辑</a>
                        <a href="/member/{{$layerModel->id}}/prolayerattr/{{ $data->id }}/destroy" class="list_btn">删除</a>
                    @else
                        <a href="/member/{{$layerModel->id}}/prolayerattr/{{ $data->id }}/restore" class="list_btn">还原</a>
                        <a href="/member/{{$layerModel->id}}/prolayerattr/{{ $data->id }}/forceDelete" class="list_btn">销毁记录</a>
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