@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>类型名称</td>
                <td>父类ID</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td><a href="/member/category/{{$data->id}}">
                        @if(mb_strlen($data->name)<6) {{ $data->name }}
                        @else {{ mb_substr($data->name,0,5,'utf-8').'...' }}
                        @endif
                    </a></td>
                <td>{{ $data->pid }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    @if($curr_list=='')
                        <a href="/member/category/{{ $data->id }}" class="list_btn">查看</a>
                        <a href="/member/category/{{ $data->id }}/edit" class="list_btn">编辑</a>
                        <a href="/member/category/{{ $data->id }}/destroy" class="list_btn">删除</a>
                    @elseif($curr_list=='trash')
                        <a href="/member/category/{{ $data->id }}/restore" class="list_btn">还原</a>
                        <a href="/member/category/{{ $data->id }}/forceDelete" class="list_btn">销毁记录</a>
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