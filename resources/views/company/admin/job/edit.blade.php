@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/company/admin/job/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="index" value="{{ $index }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>招聘岗位：</label></td>
                <td><input type="text" class="field_value" name="job" value="{{ $data->job }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>岗位人数：</label></td>
                <td><input type="text" class="field_value" name="num" value="{{ $data->num }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>岗位要求：</label></td>
                <td><textarea name="require" cols="40" rows="5">{{ $data->require }}</textarea></td>
            </tr>
            <tr><td></td></tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

