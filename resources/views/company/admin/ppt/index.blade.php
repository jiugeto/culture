@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div class="search_type">
            &nbsp;
            <span class="create_right">
                <a href="{{DOMAIN_C_BACK}}ppt/create" class="list_btn">发布宣传</a>
            </span>
        </div>
        <table cellspacing="0">
            <tr>
                <td>名称</td>
                <td>缩略图</td>
                <td>链接</td>
                <td width="150">创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td><a href="{{DOMAIN_C_BACK}}ppt/{{$data['id']}}" class="list_a">
                        {{str_limit($data['name'],20) }}</a></td>
                <td>@if($data['img'])<img src="{{$data['img']}}" width="30">@else/@endif</td>
                <td>{{str_limit($data['link'],20)}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN_C_BACK}}ppt/{{$data['id']}}" class="list_btn">查看</a>
                    <a href="{{DOMAIN_C_BACK}}ppt/{{$data['id']}}/edit" class="list_btn">编辑</a>
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