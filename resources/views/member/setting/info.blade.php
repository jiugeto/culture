@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="/member">会员后台</a> / 会员设置 / 其他更新
    </div>

    <form data-am-validator method="POST" action="{{DOMAIN}}member/setting/updateinfo/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">

        <table class="table_create">
            {{--密码--}}
            {{--<tr><td colspan="2"><div class="div_hr"></div></td></tr>--}}
            <tr><td colspan="2"><p class="center"><b>参数设置</b></p></td></tr>
            <tr>
                <td style="width:40%;"><label>列表每页显示记录数 / User Limit：</label></td>
                <td><input type="text" pattern="^[1-9]|([1-9]\d+)$" required name="limit" value="{{ $data->limit }}"/></td>
            </tr>
            <tr><td>&nbsp;</td></tr>

            <tr><td colspan="2"><div class="div_hr"></div></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td colspan="2" class="center">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop