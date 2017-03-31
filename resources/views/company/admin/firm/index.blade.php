@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div class="search_type" style="height:20px;border:0;">
            <span class="create_right"><a href="{{DOMAIN}}company/admin/firm/create" class="list_btn">添加服务</a></span>
        </div>
        <table cellspacing="0">
            <tr>
                <td>服务名称</td>
                <td>排序</td>
                <td>前台是否显示</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->sort }}</td>
                <td>{{ $data->isshow() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/firm/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}company/admin/firm/{{ $data->id }}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
                @endforeach
            @else @include('member.common.#norecord')
            @endif
        </table>
        <div style="margin:10px 20px;">@include('company.admin.common.#page')</div>
    </div>
@stop