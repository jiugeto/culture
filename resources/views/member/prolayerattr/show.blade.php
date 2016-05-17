@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">产品名称：</td>
            <td>{{ $data->product() }}</td>
        </tr>
        <tr>
            <td class="field_name">属性名称：</td>
            <td>{{ $data->attrname() }}</td>
        </tr>
        <tr>
            <td class="field_name">动画名称：</td>
            <td>{{ $data->layer() }}</td>
        </tr>
        <tr>
            <td class="field_name">动画属性：</td>
            {{--<td>{{ $data->layerAttr() }}</td>--}}
            <td>{{ $layerModel->name }}</td>
        </tr>
        <tr>
            <td class="field_name">动画点：</td>
            <td>{{ $data->per }}</td>
        </tr>
        <tr>
            <td class="field_name">动画值：</td>
            <td>{{ $data->val }}</td>
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

