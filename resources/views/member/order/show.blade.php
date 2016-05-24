@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">订单名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td class="field_name">类型：</td>
            <td>{{ $data->ganre() }}</td>
        </tr>
        <tr>
            <td class="field_name">供应方：</td>
            <td>{{ $data->sellerName }}</td>
        </tr>
        <tr>
            <td class="field_name">需求方：</td>
            <td>{{ $data->buyerName }}</td>
        </tr>
        <tr>
            <td class="field_name">状态：</td>
            <td>{{ $data->status() }}</td>
        </tr>
        <tr>
            <td class="field_name">创意价格：</td>
            <td>{{ $data->ideaMoney ? $data->ideaMoney.'元' : '免费' }}</td>
        </tr>
        <tr>
            <td class="field_name">分镜价格：</td>
            <td>{{ $data->storyMoney ? $data->storyMoney.'元' : '免费' }}</td>
        </tr>
        <tr>
            <td class="field_name">分期首款：</td>
            <td>{{ $data->realMoney1 }}元</td>
        </tr>
        <tr>
            <td class="field_name">二期付款：</td>
            <td>{{ $data->realMoney2 }}元</td>
        </tr>
        <tr>
            <td class="field_name">三期付款：</td>
            <td>{{ $data->realMoney3 }}元</td>
        </tr>
        <tr>
            <td class="field_name">分期尾款：</td>
            <td>{{ $data->realMoney4 }}元</td>
        </tr>
        <tr>
            <td class="field_name">创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updated_at ? '未更新' : $data->updated_at }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

