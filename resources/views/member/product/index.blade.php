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
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    <a href="{{DOMAIN}}online/pre/{{ $data->id }}" class="list_btn">产品预览</a>
                    <a href="{{DOMAIN}}member/product/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/product/{{ $data->id }}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop