@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td class="field_name">产品名称：</td>
            <td>{{ $data->product() }}</td>
        </tr>
        <tr>
            <td class="field_name">产品名称：</td>
            <td>{{ $data->attr() }}</td>
        </tr>
        <tr>
            <td class="field_name">类型：</td>
            <td>{{ $data->genre() }}</td>
        </tr>
        <tr>
            <td class="field_name">{{ $data->genre() }}名称：</td>
            <td>
                @if($data->genre==1)
                    {{ $data->getPicName($data->pic_id) }} <br>
                    <img src="{{ $data->getPicUrl($data->pic_id) }}" style="width:200px;">
                @elseif($data->genre==2) {{ $data->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">简介：</td>
            <td>{{ $data->intro ? $data->intro : '无' }}</td>
        </tr>
        <tr>
            <td class="field_name">创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updated_at!='0000-00-00 00:00:00' ? $data->updated_at : '未更新' }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

