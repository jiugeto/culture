@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">订单名称：</td>
            <td>{{ $data->getProductName() }}</td>
        </tr>
        <tr>
            <td class="field_name">用户名称：</td>
            <td>{{ $data->getUName() }}</td>
        </tr>
        <tr>
            <td class="field_name">类型：</td>
            <td>{{ $data->getGenreName() }}</td>
        </tr>
        <tr>
            <td class="field_name">供应方：</td>
            <td>{{ $data->getSellerName() }}</td>
        </tr>
        <tr>
            <td class="field_name">总价格(元)：</td>
            <td>{{ $data->getMoney() }}</td>
        </tr>
        <tr>
            <td class="field_name">所用福利(元)：</td>
            <td>{{ $data->getWeal() }}</td>
        </tr>
        <tr>
            <td class="field_name">需支付(元)：</td>
            <td>{{ $data->getRealmoney() }}</td>
        </tr>
        <tr>
            <td class="field_name">状态：</td>
            <td>{{ $data->getStatusName() }}</td>
        </tr>
        <tr>
            <td class="field_name">创建时间：</td>
            <td>{{ $data->createTime() }}</td>
        </tr>
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updateTime() }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

