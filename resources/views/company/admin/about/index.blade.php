@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div style="height:10px;"></div>
        <table cellspacing="0">
            <tr>
                <td>功能名称</td>
                <td>排序</td>
                <td>在前台公司页面显示否</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->sort }}</td>
                <td>{{ $data->isshow ? '显示' : '不显示' }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    <a href="/company/admin/about/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="/company/admin/about/{{ $data['id'] }}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
                @endforeach
            @else @include('member.common.norecord')
            @endif
        </table>
        <div style="margin:10px;">@include('member.common.page')</div>
    </div>
@stop