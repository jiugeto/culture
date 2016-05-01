@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div class="search_type">
            <a href="/company/admin/ppt" class="list_btn">宣传列表</a>
            <a href="/company/admin/ppt/trash" class="list_btn">回收站</a>
            @if($curr['url']!='trash')
            <span class="create_right"><a href="/company/admin/ppt/create" class="list_btn">发布宣传</a></span>
            @endif
        </div>
        <table cellspacing="0">
            <tr>
                <td>序号</td>
                <td>宣传名称</td>
                <td>排序</td>
                <td>在前台公司页面显示否</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td><a href="/company/admin/product/{{ $data['id'] }}" class="list_a">{{ $data->name ? $data->name : '企业默认信息' }}</a></td>
                <td>{{ $data->sort2 }}</td>
                <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                @if($curr['url']!='trash')
                    <a href="/company/admin/ppt/{{ $data['id'] }}" class="list_btn">查看</a>
                    <a href="/company/admin/ppt/{{ $data['id'] }}/edit" class="list_btn">编辑</a>
                    <a href="/company/admin/ppt/{{ $data['id'] }}/destroy" class="list_btn">删除</a>
                @else
                    <a href="/company/admin/ppt/{{ $data['id'] }}/restore" class="list_btn">还原</a>
                    <a href="/company/admin/ppt/{{ $data['id'] }}/forceDelete" class="list_btn">销毁</a>
                @endif
                </td>
            </tr>
                @endforeach
            @else @include('member.common.norecord')
            @endif
        </table>
        <div style="margin:10px 20px;">@include('member.common.page')</div>
    </div>
@stop