@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">资料修改</p>
            <form method="POST" action="{{DOMAIN}}person/user/{{ $user->id }}" enctype="multipart/form-data" class="list">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <h4 style="text-align:center;">个人资料</h4>
                <table class="tform">
                    <tr>
                        <td width="120">用户名：</td>
                        <td><input type="text" name="username" required value="{{ $user->username }}"></td>
                    </tr>
                    <tr>
                        <td width="100">性别：</td>
                        <td>{{ $user->sex() }}</td>
                    </tr>
                    <tr>
                        <td width="100">真实姓名：</td>
                        <td>{{ $user->realname() }}</td>
                    </tr>
                    <tr>
                        <td width="100">身份证号码：</td>
                        <td>{{ $user->idcard() }}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td>Email：</td>--}}
                        {{--<td><input type="text" name="email" value="{{ $user->email }}"></td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td>QQ：</td>
                        <td><input type="text" name="qq" value="{{ $user->qq }}"></td>
                    </tr>
                    <tr>
                        <td>座机：</td>
                        <td><input type="text" name="tel" value="{{ $user->tel }}"></td>
                    </tr>
                    <tr>
                        <td>手机：</td>
                        <td><input type="text" name="mobile" value="{{ $user->mobile }}"></td>
                    </tr>
                    <tr>
                        <td>地区：</td>
                        <td><input type="text" name="area" value="{{ $user->area }}"></td>
                    </tr>
                    <tr>
                        <td>具体地址：</td>
                        <td><input type="text" name="address" value="{{ $user->address }}"></td>
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