@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        {{--@include('member.common.lists')--}}
        <ul>
            <a href="{{DOMAIN}}member/proCus"><li>片源列表</li></a>
            <li>|</li>
        </ul>
        <div class="mem_create"><a href="{{DOMAIN}}member/proCus/create">添加片源</a></div>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>片源名称</td>
                <td>预算</td>
                <td>状态</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->getMoney1() }}</td>
                <td>{{ $data->getStatusName() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    <a href="{{DOMAIN}}member/proCus/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/proCus/{{ $data->id }}/cus" class="list_btn">供应列表</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop