@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div class="search_type">
            <h4 style="text-align:center;">花絮列表</h4>
            &nbsp;
            <span class="create_right">
                <a href="{{DOMAIN_C_BACK}}part/create" class="list_btn">发布花絮</a>
            </span>
        </div>
        <table cellspacing="0">
            <tr>
                <td>序号</td>
                <td>花絮名称</td>
                <td>花絮类型</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td><a href="{{DOMAIN_C_BACK}}part/{{$data['id']}}" class="list_a">{{$data['name']}}</a></td>
                <td>{{$data['genreName']}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN_C_BACK}}part/{{$data['id']}}" class="list_btn">查看</a>
                    <a href="{{DOMAIN_C_BACK}}part/{{$data['id']}}/edit" class="list_btn">编辑</a>
                    <a href="javascript:;" class="list_btn" onclick="alert('缩略图！');">缩略图</a>
                </td>
            </tr>
                @endforeach
            @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
            @endif
        </table>
        @include('company.admin.common.page2')
    </div>
@stop