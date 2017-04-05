@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div class="search_type">
            {{--页面类型：--}}
            {{--<select name="type">--}}
                {{--<option value="0" {{ $type==0 ? 'selected' : '' }}>所有</option>--}}
                {{--<option value="1" {{ $type==1 ? 'selected' : '' }}>公司简介</option>--}}
                {{--<option value="2" {{ $type==2 ? 'selected' : '' }}>公司历程</option>--}}
                {{--<option value="3" {{ $type==3 ? 'selected' : '' }}>公司新闻</option>--}}
                {{--<option value="4" {{ $type==4 ? 'selected' : '' }}>行业资讯</option>--}}
            {{--</select>--}}
            &nbsp;
            <span class="create_right"><a href="{{DOMAIN_C_BACK}}about/create" class="list_btn">添加简介</a></span>
        </div>
        <table cellspacing="0">
            <tr>
                <td>简介名称</td>
                <td>内容</td>
                <td width="150">创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{$data['name']}}</td>
                <td>{{str_limit($data['intro'],10)}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN_C_BACK}}about/{{$data['id']}}" class="list_btn">查看</a>
                    <a href="{{DOMAIN_C_BACK}}about/{{$data['id']}}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
                @endforeach
            @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
            @endif
        </table>
        {{--@include('company.admin.common.page2')--}}
    </div>

    {{--<script>--}}
        {{--$("select[name='type']").change(function(){--}}
            {{--if ($(this).val()==0) {--}}
                {{--window.location.href = '{{DOMAIN}}company/admin/about';--}}
            {{--} else {--}}
                {{--window.location.href = '{{DOMAIN}}company/admin/about/t/'+$(this).val();--}}
            {{--}--}}
        {{--});--}}
    {{--</script>--}}
@stop