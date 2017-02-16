@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--<div class="mem_tab">@include('member.common.lists')</div>--}}
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>产品名称</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas)>1)
            @foreach($datas as $kdata=>$data)
                @if(is_numeric($kdata))
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['createTime'] }}</td>
                <td>
                    <a href="{{DOMAIN}}member/product/{{ $data['id'] }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/product/{{ $data['id'] }}/edit" class="list_btn">编辑</a>
                    <a href="{{env('ONLINE_DOMAIN')}}" target="_blank" class="list_btn">预览</a>
                </td>
            </tr>
                @endif
            @endforeach
        @else @include('member.common.#norecord')
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop