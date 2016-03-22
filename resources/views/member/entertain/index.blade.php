@extends('member.main')
@section('content')
    @include('member.common.crumb')
    @include('member.entertain.search')
    <div class="mem_tab">@include('member.common.menus')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>娱乐名称</td>
                <td>供求类别</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->genre==1 ? '娱乐供应' : '娱乐需求' }}</td>
                <td>{{ $data->uname }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    <a href="/member/entertain/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="/member/entertain/{{ $data->id }}/edit" class="list_btn">编辑</a>
                    <a href="/member/entertain/{{ $data->id }}/destroy" class="list_btn">删除</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop