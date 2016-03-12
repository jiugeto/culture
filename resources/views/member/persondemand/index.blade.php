@extends('member.main')
@section('content')
    <div class="mem_crumb">会员后台 / 个人需求</div>
    <div class="mem_tab">
        <ul>
            @foreach($menus as $kmenu=>$menu)
            <a href="/member/{{$kmenu}}"><li>{{$menu}}</li></a><li>|</li>
            @endforeach
        </ul>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>需求名称</td>
                <td>类型</td>
                <td>分类</td>
                <td>发布人</td>
                <td>创建时间</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->type }}</td>
                <td>{{ $data->cate_id }}</td>
                <td>{{ $data->uname }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop