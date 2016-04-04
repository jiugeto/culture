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
                <form class="am-form" data-am-validator method="POST" action="/admin/admin/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>用户名 / User Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="username" value="{{ $data->username }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>真实名字 / Real Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="realname" value="{{ $data->realname }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>密码 / Password：</label>
                            <input type="text" placeholder="至少5个字符" minlength="5" required name="password" value="{{ $data->password }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>Email / email：</label>
                            <input type="text" placeholder="例：12345@qq.com" pattern="^[0-9a-zA-Z-_]+@([0-9a-zA-Z-_])+(.[0-9a-zA-Z-_])+$" required name="email" value="{{ $data->email }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>所在角色组 / Role：</label>
                            <select name="role_id">
                            @foreach($roleModels as $roleModel)
                                <option value="{{ $roleModel->id }}"
                                        {{ $data->role_id==$roleModel->id ? 'selected' : '' }}>
                                    {{ $roleModel->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

