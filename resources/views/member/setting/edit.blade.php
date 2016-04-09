@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/setting/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">

        <table class="table_create">
            {{--基本信息--}}
            <tr><td colspan="2"><p class="center"><b>基本设置</b></p></td></tr>
            <tr>
                <td><label>用户名 / User Name：</label></td>
                <td><input type="text" placeholder="至少2个字符" minlength="2" required name="username" value="{{ $data->username }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>邮箱 / Email：</label></td>
                <td><input type="text" placeholder="例：123@qq.com" pattern="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" name="email" value="{{ $data->email }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>qq / QQ：</label></td>
                <td><input type="text" name="qq" value="{{ $data->qq }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>电话 / Tel：</label></td>
                <td><input type="text" name="tel" value="{{ $data->tel }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>手机 / Mobile：</label></td>
                <td><input type="text" name="mobile" value="{{ $data->mobile }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>用户类型 / Genre：</label></td>
                <td>
                    <input type="radio" name="genre" value="1"> 普通用户&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="genre" value="2"> 普通用户&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>

            {{--密码--}}
            <tr><td colspan="2"><div class="div_hr"></div></td></tr>
            <tr><td colspan="2"><p class="center"><b>密码修改</b></p></td></tr>
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
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop