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
                <td>名称</td>
                <td>类型</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->getGenreName() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    @if($data->genre==1)
                        <a href="{{DOMAIN}}member/proVideo/pre/{{ $data->id }}" target="_blank" class="list_btn">预览</a>
                    @elseif($data->genre==2)
                        <a href="{{ $data->link }}" target="_blank" class="list_btn">预览</a>
                    @endif
                    <a href="{{DOMAIN}}member/proVideo/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/proVideo/{{ $data->id }}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop