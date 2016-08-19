@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--@include('member.product.search')--}}
    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai"></div>
    {{--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pname ? '此为'.$pname.'的属性' : '' }}--}}
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>属性名称</td>
                <td>产品名称</td>
                <td></td>
                <td>创建时间</td>
                <td a>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->product() }}</td>
                <td></td>
                <td>{{ $data->created_at }}</td>
                <td>
                {{--@if($curr['url']=='')--}}
                    <a href="{{DOMAIN}}member/productattr/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/productattr/{{ $data->id }}/edit" class="list_btn">编辑</a>
                    <a href="{{DOMAIN}}member/productattr/{{ $data->id }}/edit2" class="list_btn">二级样式</a>
                    <div style="height:10px;">{{--空白--}}</div>
                    <a href="{{DOMAIN}}member/productattr/{{ $data->id }}/edit3" class="list_btn">三级样式</a>
                    <a href="{{DOMAIN}}member/productattr/{{ $data->id }}/edit4" class="list_btn">图片样式</a>
                    <a href="{{DOMAIN}}member/productattr/{{ $data->id }}/edit5" class="list_btn">文字样式</a>
                    {{--<a href="{{DOMAIN}}member/productattr/{{ $data->id }}/destroy" class="list_btn">删除</a>--}}
                {{--@else--}}
                    {{--<a href="{{DOMAIN}}member/productattr/{{ $data->id }}/restore" class="list_btn">还原</a>--}}
                    {{--<a href="{{DOMAIN}}member/productattr/{{ $data->id }}/forceDelete" class="list_btn">销毁记录</a>--}}
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