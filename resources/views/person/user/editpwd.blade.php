@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">密码修改</p>
            <form method="POST" action="{{DOMAIN}}person/user/pwd/{{ $user->id }}" enctype="multipart/form-data" class="list">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <h4 style="text-align:center;">更新密码</h4>
                <table class="tform">
                    <tr>
                        <td width="120">老密码：</td>
                        <td><input type="text" name="oldpwd"></td>
                    </tr>
                    <tr>
                        <td width="120">再次输入：</td>
                        <td><input type="text" name="oldpwd2"></td>
                    </tr>
                    <tr>
                        <td width="120">新密码：</td>
                        <td><input type="text" name="newpwd"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <a onclick="history.go(-1);">返回上一页</a>
                            <button type="submit" class="companybtn">保存修改</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        @include('person.user.head')
    </div>
@stop