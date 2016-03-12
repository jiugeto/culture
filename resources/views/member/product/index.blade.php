@extends('member.main')
@section('content')
    <div class="mem_crumb">会员后台 / 视频在线</div>
    @include('member.product.search')
    <div class="mem_tab">
        <ul>
            <a href=""><li>所有列表</li></a><li>|</li>
            <a href=""><li>回收站</li></a><li>|</li>
        </ul>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>视频名称</td>
                <td>视频主体</td>
                <td>发布人</td>
                <td>创建时间</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
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