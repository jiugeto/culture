@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        @include('company.admin.info.search')
        <table cellspacing="0">
            <tr>
                {{--<td>序号</td>--}}
                <td>信息名称</td>
                @if(!$type)<td>信息类型</td>@endif
                <td>在前台公司页面显示否</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                {{--<td>{{ $data->id }}</td>--}}
                <td><a href="/company/admin/info/{{ $data['id'] }}" class="list_a">{{ $data->name ? $data->name : '企业默认信息' }}</a></td>
                @if(!$type)<td>{{ $data->type() }}</td>@endif
                <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                {{--@if($curr['url']!='trash')--}}
                    <a href="/company/admin/info/{{ $data['id'] }}" class="list_btn">查看</a>
                    <a href="/company/admin/info/{{ $data['id'] }}/edit" class="list_btn">编辑</a>
                    {{--<a href="/company/admin/info/{{ $data['id'] }}/destroy" class="list_btn">删除</a>--}}
                {{--@else--}}
                    {{--<a href="/company/admin/info/{{ $data['id'] }}/restore" class="list_btn">还原</a>--}}
                    {{--<a href="/company/admin/info/{{ $data['id'] }}/forceDelete" class="list_btn">销毁</a>--}}
                {{--@endif--}}
                </td>
            </tr>
                @endforeach
            @else @include('member.common.norecord')
            @endif
        </table>
        <div style="margin:10px 20px;">每个公司每个类型只能有一条记录</div>
        {{--<div style="margin:10px 20px;">@include('member.common.page')</div>--}}
    </div>
@stop