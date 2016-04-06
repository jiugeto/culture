@extends('loginOrRegist.main')
@section('content')
    <form action="/login" method="POST" data-am-validator>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="login_div login_first"><input type="text" placeholder="用户名\手机\邮箱(至少2位)" minlength="2" minlength="50" name="username" required></div>
        <div class="login_div"><input type="text" placeholder="密码(至少6位)" minlength="6" name="password" required></div>
        <div class="login_div"><input type="text" placeholder="再次输入密码(至少6位)" minlength="6" name="password_confirmation" required></div>
        <div class="login_div login_last"><input type="text" placeholder="验证码" minlength="4" maxlength="4" name="captcha" required><a href="" class="captcha">{!! captcha_img() !!}</a></div>
        <div class="small">看不清？点击上面换一张</div>
        <div>&nbsp;</div>
        <div><input type="submit" class="regist" value="登录会员"></div>
    </form>
@stop