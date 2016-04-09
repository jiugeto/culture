@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/setting/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">

        <table class="table_create">
            {{--密码--}}
            <tr><td colspan="2"><div class="div_hr"></div></td></tr>
            <tr><td colspan="2"><p class="center"><b>密码修改</b></p></td></tr>
            <tr>
                <td style="width:40%;"><label>用户名 / User Name：</label></td>
                <td>{{ $data->username }}</td>
            </tr>
            {{--<tr><td>&nbsp;</td></tr>--}}
            <tr>
                <td><label>旧密码 / PWD：</label></td>
                <td><input type="text" placeholder="6-12字符" minlength="2" maxlength="12" name="password"/></td>
            </tr>
            <tr>
                <td><label>新密码 / PWD：</label></td>
                <td><input type="text" placeholder="6-12字符" minlength="2" maxlength="12" name="password2"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>

            <tr><td colspan="2"><div class="div_hr"></div></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td colspan="2" class="center">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn" name="submit" value="pwd">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop