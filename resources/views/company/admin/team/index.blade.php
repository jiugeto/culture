@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div class="search_type" style="height:20px;border:0;">
            <span class="create_right">
                <a href="{{DOMAIN}}company/admin/team/create" class="list_btn">添加员工</a>
            </span>
        </div>
        <table cellspacing="0">
            <tr>
                <td>员工名称</td>
                <td>缩略图</td>
                <td>排序</td>
                <td>前台公司是否显示</td>
                <td width="150">创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td><div style="width:60px;height:30px;overflow:hidden;"><img src="{{ $data->pic()->url }}" style="@if($size=$data->getUserPicSize($data->pic(),$w=50,$h=30))width:{{$size['w']}}px;height:{{$size['h']}}px;@endif"></div></td>
                <td>{{ $data->sort }}</td>
                <td>{{ $data->isshow() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/team/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}company/admin/team/{{ $data->id }}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
                @endforeach
            @else @include('member.common.#norecord')
            @endif
        </table>
        <div style="margin:10px 20px;">@include('company.admin.common.#page')</div>
    </div>
@stop