@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-form-group">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{DOMAIN}}admin/user">
                                <button type="button" class="am-btn am-btn-default">
                                    <img src="{{PUB}}assets/images/redo.png" class="icon"> 返回用户列表
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/user" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>用户名 / User Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="username"/>
                        </div>

                        <div class="am-form-group">
                            <label>密码 / Password：</label>
                            <br>默认：123456
                            {{--<input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="username"/>--}}
                        </div>

                        <div class="am-form-group">
                            <label>邮箱 / Email：</label>
                            <br>自定义
                            {{--<input type="text" placeholder="你的邮箱" pattern="^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$" required name="email"/>--}}
                        </div>

                        <div class="am-form-group">
                            <label>QQ / QQ：</label>
                            <br>自定义
                            {{--<input type="text" placeholder="qq号码" name="qq"/>--}}
                        </div>

                        <div class="am-form-group">
                            <label>电话 / Telphone：</label>
                            <br>自定义
                            {{--<input type="text" placeholder="座机号码" pattern="^\d+$" name="tel"/>--}}
                        </div>

                        <div class="am-form-group">
                            <label>手机 / Mobile：</label>
                            <br>自定义
                            {{--<input type="text" placeholder="手机号码" pattern="^\d+$" name="tel"/>--}}
                        </div>

                        <div class="am-form-group">
                            <label>城市 / City：</label>
                            <br>自定义
                        </div>

                        <div class="am-form-group">
                            <label>地址 / Address：</label>
                            <br>自定义
                            {{--<input type="text" placeholder="住址" minlength="2" maxlength="20" name="address"/>--}}
                        </div>

                        <div class="am-form-group">
                            <label>头像 / Head：</label>
                            <br>自定义
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

