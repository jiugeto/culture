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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/wallet" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>用户名 / User Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="username"/>
                        </div>

                        <button type="button" class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

