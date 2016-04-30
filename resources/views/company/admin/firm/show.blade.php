@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">服务名称：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td class="field_name">公司名称：</td>
                <td>{{ $data->cid ? $data->company()->name : '初始默认服务' }}</td>
            </tr>
            <tr>
                <td class="field_name">简单介绍：</td>
                <td><div class="admin_show_con">{!! $data->intro ? $data->intro : '无' !!}</div></td>
            </tr>
            <tr>
                <td class="field_name">标题：</td>
                <td>{{ $data->title }}</td>
            </tr>
            <tr>
                <td class="field_name">图片：</td>
                <td>
                    @if($data->pic_id)
                        {{ $data->pic()->name }}<br><img src="{{ $data->pic()->url }}">
                    @else 无
                    @endif
                </td>
            </tr>
            <tr>
                <td class="field_name">排序：</td>
                <td>{{ $data->sort2 }}</td>
            </tr>
            <tr>
                <td class="field_name">前台显示否：</td>
                <td>{{ $data->isshow2 ? '显示' : '不显示' }}</td>
            </tr>
            <tr>
                <td class="field_name">创建时间：</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            <tr>
                <td class="field_name">更新时间：</td>
                <td>{{ $data->updated_at=='0000-00-00 00:00:00' ? '未更新' : $data->updated_at }}</td>
            </tr>

            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    {{--<a href="/company/admin/job/{{$data->id}}/edit">--}}
                        {{--<button class="companybtn">修&nbsp;&nbsp;改</button></a>--}}
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

