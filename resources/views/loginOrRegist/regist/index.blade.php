@extends('loginOrRegist.main')
@section('content')
    <div class="login">
        <table>
            <tr>
                <td><img src="/assets-home/images/register-login-left.png"></td>
                <td>
                    <table class="login_right">
                        <tr>
                            <td class="login_text">
                                <a href="#">注册</a>
                                <a href="#">登陆</a>
                            </td>
                        </tr>
                        <tr><td>
                            <form action="/regist" method="POST" data-am-validator>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div><input type="text" class="login_first" placeholder="&nbsp;&nbsp;&nbsp;用户名" name="username" required></div>
                                <div><input type="text" placeholder="&nbsp;&nbsp;&nbsp;邮箱" name="email" required></div>
                                <div><input type="text" placeholder="&nbsp;&nbsp;&nbsp;密码" name="password" required></div>
                                <div><input type="text" class="login_last" placeholder="&nbsp;&nbsp;&nbsp;验证码" name="captcha" required></div>
                                <div>&nbsp;</div>
                                <div><input type="submit" class="regist" value="注册会员"></div>
                            </form>
                            </td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@stop