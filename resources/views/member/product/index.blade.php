@extends('member.main')
@section('content')
    @include('member.common.crumb')
    @include('member.product.search')
    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>视频名称</td>
                <td>gif缩略图</td>
                <td>视频主体</td>
                <td>发布人</td>
                <td>创建时间</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->gif }}</td>
                <td>{{ $data->genre==1 ? '个人' :'企业' }}</td>
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