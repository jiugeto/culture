@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        @include('company.admin.single.menu')
        <h4 style="text-align:center;">单页功能列表</h4>
        <table cellspacing="0">
            <tr>
                <td>页面名称</td>
                <td>模块名称</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data['name']}}</td>
                        <td>{{$data['moduleName']}}</td>
                        <td>{{$data['createTime']}}</td>
                        <td>
                            <a href="{{DOMAIN_C_BACK}}single/{{$data['id']}}" class="list_btn">查看</a>
                            <a href="{{DOMAIN_C_BACK}}single/{{$data['id']}}/edit" class="list_btn">编辑</a>
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