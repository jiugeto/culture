@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/job" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $id }}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>招聘岗位：</label></td>
                    <td class="right"><input type="text" class="field_value" name="job"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>岗位人数：</label></td>
                    <td class="right"><input type="text" class="field_value" name="num"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>岗位要求：</label></td>
                    <td class="right"><textarea name="require" cols="40" rows="5"></textarea></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="companybtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

