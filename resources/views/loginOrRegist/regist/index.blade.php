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
                                <div class="login_div login_first"><input type="text" placeholder="用户名(至少2位)" minlength="2" minlength="50" name="username" required></div>
                                <div class="login_div"><input type="text" placeholder="邮箱" pattern="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" name="email" required></div>
                                <div class="login_div"><input type="text" placeholder="密码(至少6位)" minlength="6" name="password" required></div>
                                <div class="login_div login_last"><input type="text" placeholder="验证码" minlength="4" maxlength="4" name="captcha" required><a href="" class="captcha">{!! captcha_img() !!}</a></div>
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