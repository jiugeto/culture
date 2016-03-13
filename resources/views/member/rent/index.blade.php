@extends('member.main')
@section('content')
    @include('member.common.crumb')
    @include('member.rent.search')
    <div class="mem_tab">@include('member.common.menus')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>器材名称</td>
                <td>供求关系</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->genre==1 ? '需求方' : '供应方' }}</td>
                <td>{{ $data->uname }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    @if($curr=='')
                        <a href="/member/rent/{{ $data->id }}" class="list_btn">查看</a>
                        <a href="/member/rent/{{ $data->id }}/edit" class="list_btn">编辑</a>
                        <a href="/member/rent/{{ $data->id }}/destroy" class="list_btn">删除</a>
                    @elseif($curr=='trash')
                        <a href="/member/rent/{{ $data->id }}/restore" class="list_btn">还原</a>
                        <a href="/member/rent/{{ $data->id }}/forceDelete" class="list_btn">销毁记录</a>
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