@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/role" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>角色名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>角色介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label>密码 / Password：</label>--}}
                            {{--<input type="text" placeholder="至少6位数" pattern="^\d{6,}$" required name="password"/>--}}
                        {{--</div>--}}

                        {{--<div class="am-form-group">--}}
                            {{--<label>管理员id / Admin Id：</label>--}}
                            {{--<select name="admin_id">--}}
                                {{--<option value="">-请选择-</option>--}}
                                {{--@foreach($roles as $role)--}}
                                    {{--<option value="{{ $role->id }}">{{ $role->name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        <button class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

