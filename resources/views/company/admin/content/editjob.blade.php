@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/entertain/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_methodn" value="POST">
        <table class="table_create">
            <tr>
                <td><label>招聘岗位：</label></td>
                <td><input type="text" name="job" value="{{ $data->job }}"/></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>招聘岗位yao要求：</label>d>
                <td><textarea name="jon_require" cols="40" rows="10">{{ $data->jib_require }}</textarea></td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td><label>前台是否显示 / Show：</label></td>
                <td>
                    <label><input type="radio" name="isshow" value="0" {{ $data->isshow2==0 ? 'checked' : '' }}/> 不显示&nbsp;&nbsp;</label>
                    <label><input type="radio" name="isshow" value="1" {{ $data->isshow2==1 ? 'checked' : '' }}/> 显示&nbsp;&nbsp;</label>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存修改</button>
                </td></tr>
        </table>
    </form>
@stop

