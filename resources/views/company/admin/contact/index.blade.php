@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">公司座机：</td>
                <td>{{ $data->areacode.'-'.$data->tel }}</td>
            </tr>
            <tr>
                <td class="field_name">企业QQ：</td>
                <td>{{ $data->qq }}</td>
            </tr>
            <tr>
                <td class="field_name">公司网址：</td>
                <td>{{ $data->web }}</td>
            </tr>
            <tr>
                <td class="field_name">传真：</td>
                <td>{{ $data->fax }}</td>
            </tr>
            <tr>
                <td class="field_name">邮编：</td>
                <td>{{ $data->zipcode }}</td>
            </tr>
            <tr>
                <td class="field_name">企业邮箱：</td>
                <td>{{ $data->email }}</td>
            </tr>

            <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                    <a href="/company/admin/contact/{{$data->id}}/edit">
                        <button class="companybtn">修&nbsp;&nbsp;改</button></a>
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop

