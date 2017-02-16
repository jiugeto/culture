@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        @include('company.admin.single.menu')
        <table cellspacing="0">
            <tr>
                <td>模块名称</td>
                <td>排序</td>
                <td>显示否</td>
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
                            <a href="{{DOMAIN}}company/admin/singlemodule/{{ $data->id }}" class="list_btn">查看</a>
                            <a href="{{DOMAIN}}company/admin/singlemodule/{{ $data->id }}/edit" class="list_btn">编辑</a>
                        </td>
                    </tr>
                @endforeach
            @else @include('member.common.#norecord')
            @endif
        </table>
        <div style="margin:10px;">@include('company.admin.common.page')</div>
    </div>
@stop