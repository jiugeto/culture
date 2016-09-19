@extends('loginOrRegist.main')
@section('content')
    <form action="/regist/doregist" method="POST" data-am-validator>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="login_div login_first"><input type="text" placeholder="用户名(2~50字符)" minlength="2" minlength="50" name="username" required></div>
        <div class="login_div"><input type="text" placeholder="邮箱" pattern="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" name="email" required></div>
        <div class="login_div"><input type="password" placeholder="密码(至少6~12字符)" minlength="6" minlength="12" name="password" required></div>
        {{--<div class="login_div"><input type="text" placeholder="再次输入密码(至少6~12字符)" minlength="6" minlength="12" name="password_confirmation" required></div>--}}
        <div class="login_div"><input type="text" placeholder="再次输入密码(至少6~12字符)" minlength="6" minlength="12" name="password2" required></div>
        <div class="login_div login_last"><input type="text" placeholder="验证码" minlength="4" maxlength="4" name="captcha" required><a href="javascript:void(0)" class="captcha" onclick="yzmfresh(this);">{!! captcha_img() !!}</a></div>
        <div class="small">看不清？点击上面换一张</div>
        {{--<div class="remember">--}}
            {{--<input type="checkbox" name="remember" value="1">记住密码--}}
            {{--<div>忘记密码？</div>--}}
        {{--</div>--}}
        <div>&nbsp;</div>
        <div><input type="submit" class="regist" value="注册会员"></div>
    </form>

    <script>
        function yzmfresh(elem) {
            var src = $(elem).find('img');
            var http = src.attr('src').split('?')[0];
            src.attr('src', http + '?' + Math.random());
        }
    </script>
@stop