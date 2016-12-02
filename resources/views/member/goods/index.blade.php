@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--<div class="p_style">需求类型：--}}
        {{--<a href="{{DOMAIN}}member/{{$lists['func']['url']=='goodsD'?'goodsD':'goodsS'}}">视频</a>--}}
        {{--<a href="{{DOMAIN}}member/design">设计</a>--}}
    {{--</div>--}}
    <div class="hr_tab"></div>

    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>

    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>需求名称</td>
                <td>分类</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ str_limit($data->name,20) }}</td>
                <td>{{ $data->getCate() }}</td>
                <td>{{ $data->getuserName() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    <a href="{{DOMAIN}}product/video/{{ $data->id }}/{{ $data->video_id }}" target="_blank" class="list_btn">预览</a>
                    <a href="{{DOMAIN}}member/goods/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/goods/{{ $data->id }}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop