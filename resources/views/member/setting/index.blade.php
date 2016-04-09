@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/setting/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">

        <table class="table_create">
            {{--基本信息--}}
            <tr><td colspan="2">
                    <p class="center"><b>基本设置</b></p>
                </td></tr>
            <tr>
                <td style="width:40%;"><label>用户名 / User Name：</label></td>
                <td>{{ $data->username }}
                    {{--<input type="text" placeholder="至少2个字符" minlength="2" required name="username" value="{{ $data->username }}"/>--}}
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>邮箱 / Email：</label></td>
                <td><input type="text" placeholder="例：123@qq.com" pattern="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" name="email" value="{{ $data->email }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>qq / QQ：</label></td>
                <td><input type="text" name="qq" value="{{ $data->qq }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>电话 / Tel：</label></td>
                <td><input type="text" name="tel" value="{{ $data->tel }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>手机 / Mobile：</label></td>
                <td><input type="text" name="mobile" value="{{ $data->mobile }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td><label>用户类型 / Genre：</label></td>
                <td>
                    @foreach($isusers as $key=>$isuser)
                        <label><input type="radio" name="isuser" value="{{$key}}">{{ $isuser }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if($key%3==0) <br> @endif
                    @endforeach
                    {{--<select name="isuser" required>--}}
                        {{--<option value="">请选择</option>--}}
                        {{--@foreach($isusers as $key=>$isuser)--}}
                            {{--<option value="{{ $key }}">{{ $isuser }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                </td>
            </tr>
            <tr><td>&nbsp;</td></tr>

            <tr><td colspan="2"><div class="div_hr"></div></td></tr>
            <tr><td colspan="2" class="center">
                    <a href="/member/setting/pwd/{{ $data->id }}"><button class="companybtn">更新密码</button></a>
                </td></tr>
            {{--<tr><td colspan="2"><p class="center">--}}
            {{--<a href="/member/setting/pwd/{{ $data->id }}" class="">更新密码</a>--}}
            {{--</p></td></tr>--}}

            <tr><td colspan="2"><div class="div_hr"></div></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td colspan="2" class="center">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn" name="submit" value="basic">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop