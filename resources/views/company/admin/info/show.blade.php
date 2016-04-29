@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')
    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">{{ $data->type?$types[$data->type]:'信息' }}名称：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td class="field_name">内容 ：</td>
                <td>{!! $data->intro !!}</td>
            </tr>
            <tr>
                <td class="field_name">图片 ：</td>
                <td>
                    @if($data->pic && isset($data->pics) && $data->pics)
                    @foreach($data->pics as $pic)
                        {{ $data->pic($pic)->name }}<br><img src="{{ $data->pic($pic)->url }}">
                    @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td class="field_name">公司前台是否置顶：</td>
                <td>{{ $data->istop2 ? '置顶' : '不置顶' }}</td>
            </tr>

            <tr>
                <td class="field_name">排序：</td>
                <td>{{ $data->sort2 }}</td>
            </tr>

            <tr>
                <td class="field_name">公司前台显示否：</td>
                <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
            </tr>

            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/job/{{$data->id}}/edit">--}}
                        {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

