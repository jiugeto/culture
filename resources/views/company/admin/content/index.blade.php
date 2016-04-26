@extends('company.admin.main')
@section('content')
    <div class="com_admin_list">
        <table cellspacing="0">
            <tr>
                <td>序号</td>
                <td>功能名称</td>
                <td>排序</td>
                <td>在前台公司页面显示否</td>
                <td>创建时间</td>
            </tr>
            <tr><td colspan="5"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->sort }}</td>
                <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
                @endforeach
            @endif
        </table>
    </div>
@stop