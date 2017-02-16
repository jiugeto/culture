@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <form data-am-validator method="POST" action="{{DOMAIN}}member/goodscus/{{$data['id']}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <p style="text-align:center;"><b>片源定制修改</b></p>
        <table class="table_create">
            <tr>
                <td class="field_name"><label>片源名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data['name'] }}"/></td>
            </tr>

            <tr>
                <td class="field_name"><label>效果说明：</label></td>
                <td>
                    <textarea cols="30" rows="5" name="intro" required minlength="2" maxlength="1000"
                              style="resize:none;">{{$data['intro']}}</textarea>
                </td>
            </tr>

            <tr>
                <td class="field_name"><label>预算(元)：</label></td>
                <td><input type="text" name="money" placeholder="样片制作预算" pattern="^\d+$" required value="{{$data['money']}}"></td>
            </tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

