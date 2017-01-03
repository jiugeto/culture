@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="/member">会员后台</a> / 会员设置 / 更新密码
    </div>

    <form data-am-validator method="POST" action="{{DOMAIN}}member/setting/updatepwd/{{ $data['id'] }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">

        <table class="table_create">
            {{--密码--}}
            {{--<tr><td colspan="2"><div class="div_hr"></div></td></tr>--}}
            <tr class="field_name"><td colspan="2"><p class="center"><b>密码修改</b></p></td></tr>
            <tr>
                <td class="field_name" style="width:40%;"><label>用户名：</label></td>
                <td>{{ $data['username'] }}</td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td class="field_name"><label>旧密码：</label></td>
                <td><input type="text" placeholder="6-12字符" minlength="2" maxlength="12" name="password"/></td>
            </tr>
            <tr>
                <td class="field_name"><label>新密码：</label></td>
                <td><input type="text" placeholder="6-12字符" minlength="2" maxlength="12" name="password2"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>

            <tr><td colspan="2"><div class="div_hr"></div></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td colspan="2" class="center">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop