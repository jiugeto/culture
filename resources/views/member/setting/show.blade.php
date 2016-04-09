@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <table class="table_create">
        <tr>
            <td style="width:40%;"><label>用户名 / User Name：</label></td>
            <td>{{ $data->username }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>邮箱 / Email：</label></td>
            <td>{{ $data->email }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>qq / QQ：</label></td>
            <td>{{ $data->qq }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>电话 / Tel：</label></td>
            <td>{{ $data->tel }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>手机 / Mobile：</label></td>
            <td>{{ $data->mobile }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>用户类型 / Genre：</label></td>
            <td>{{ $data->isuser() }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>

        <tr><td colspan="2"><div class="div_hr"></div></td></tr>
        <tr><td colspan="2" class="center">
                <a href="/member/setting/pwd/{{ $data->id }}"><button class="companybtn">更新密码</button></a>
            </td></tr>

        <tr><td colspan="2"><div class="div_hr"></div></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td colspan="2" class="center">
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
            </td></tr>
    </table>
@stop