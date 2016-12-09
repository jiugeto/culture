@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/admin/setpwd/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>老密码 / Old Password：</label>
                            <input type="text" placeholder="至少5个字符" minlength="5" required name="pwd1"/>
                        </div>

                        <div class="am-form-group">
                            <label>再次输入老密码 / Old Password2：</label>
                            <input type="text" placeholder="至少5个字符" minlength="5" required name="pwd2"/>
                        </div>

                        <div class="am-form-group">
                            <label>新密码 / New Password：</label>
                            <input type="text" placeholder="至少5个字符" minlength="5" required name="pwd3"/>
                        </div>

                        <button class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

