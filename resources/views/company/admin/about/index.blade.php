@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div class="search_type">
            页面类型：
            <select name="type">
                <option value="0" {{ $type==0 ? 'selected' : '' }}>所有</option>
                <option value="1" {{ $type==1 ? 'selected' : '' }}>公司简介</option>
                <option value="2" {{ $type==2 ? 'selected' : '' }}>公司历程</option>
                <option value="3" {{ $type==3 ? 'selected' : '' }}>公司新闻</option>
                <option value="4" {{ $type==4 ? 'selected' : '' }}>行业资讯</option>
            </select>
            <span class="create_right"><a href="/company/admin/about/create" class="list_btn">添加页面</a></span>
        </div>
        <table cellspacing="0">
            <tr>
                <td>页面名称</td>
                <td>所属模块</td>
                <td>类型</td>
                <td width="100">公司前台是否显示</td>
                <td width="150">创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{ $data->getModuleName() }}</td>
                <td>{{ $data->type() }}</td>
                <td>{{ $data->isshow() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/about/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}company/admin/about/{{ $data->id }}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
                @endforeach
            @else @include('member.common.norecord')
            @endif
        </table>
        <div style="margin:10px 20px;">@include('company.admin.common.page')</div>
    </div>

    <script>
        $("select[name='type']").change(function(){
            if ($(this).val()==0) {
                window.location.href = '{{DOMAIN}}company/admin/about';
            } else {
                window.location.href = '{{DOMAIN}}company/admin/about/t/'+$(this).val();
            }
        });
    </script>
@stop