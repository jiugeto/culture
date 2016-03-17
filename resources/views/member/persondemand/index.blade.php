@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">@include('member.common.menus')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>需求名称</td>
                {{--<td>类型</td>--}}
                <td>分类</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
{{--                <td>{{ $data->type }}</td>--}}
                <td>{{ $data->cate_id }}</td>
                <td>{{ $data->uname }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    <a href="/member/persondemand/{{ $data->id }}/pre" class="list_btn">预览</a>
                    <a href="/member/persondemand/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="/member/persondemand/{{ $data->id }}/edit" class="list_btn">编辑</a>
                    <a href="/member/persondemand/{{ $data->id }}/destroy" class="list_btn">删除</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop