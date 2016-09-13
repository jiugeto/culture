@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        @include('company.admin.product.menu')
        <table cellspacing="0">
            <tr>
                <td>序号</td>
                <td>产品名称</td>
                <td>预览图</td>
                <td>产品类型</td>
                <td>前台是否显示</td>
                <td width="150">创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td><a href="{{DOMAIN}}company/admin/product/{{ $data['id'] }}" class="list_a">
                        {{ $data->name ? $data->name : '企业默认信息' }}</a></td>
                <td><div style="width:60px;height:30px;overflow:hidden;"><img src="{{ $data->pic()->url }}" style="@if($size=$data->getUserPicSize($data->pic(),$w=50,$h=30))width:{{$size}}px;@endif height:30px;"></div></td>
                <td>{{ $data->getCate() }}</td>
                <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                {{--@if($curr['url']!='trash')--}}
                    <a href="{{DOMAIN}}company/admin/product/{{ $data['id'] }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}company/admin/product/{{ $data['id'] }}/edit" class="list_btn">编辑</a>
                    <div style="height:10px;"></div>
                    <a href="{{DOMAIN}}product/video/{{ $data['id'] }}/{{ $data['video_id'] }}" target="_blank" class="list_btn">预览</a>
                    {{--<a href="{{DOMAIN}}company/admin/product/{{ $data['id'] }}/destroy" class="list_btn">删除</a>--}}
                {{--@else--}}
                    {{--<a href="{{DOMAIN}}company/admin/product/{{ $data['id'] }}/restore" class="list_btn">还原</a>--}}
                    {{--<a href="{{DOMAIN}}company/admin/product/{{ $data['id'] }}/forceDelete" class="list_btn">销毁</a>--}}
                {{--@endif--}}
                </td>
            </tr>
                @endforeach
            @else @include('member.common.norecord')
            @endif
        </table>
        <div style="margin:10px 20px;">@include('company.admin.common.page')</div>
    </div>
@stop