@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/job/{{ $data->id }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>招聘名称：</label></td>
                    <td class="right"><input type="text" class="field_value" name="name" value="{{ $data->name }}"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>简介：</label></td>
                    <td class="right"><textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>招聘岗位：</label></td>
                    <td class="right"><input type="text" class="field_value" name="job" value="{{ $data->job }}"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>岗位人数：</label></td>
                    <td class="right"><input type="text" class="field_value" name="num" value="{{ $data->num }}"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>岗位要求：</label></td>
                    <td class="right"><textarea name="require" cols="40" rows="5">{{ $data->require }}</textarea></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>是否置顶：</label></td>
                    <td class="right">
                        <label><input type="radio" name="istop2" value="0" {{ $data->istop2==0 ? 'checked' : '' }}> 不置顶&nbsp;&nbsp;</label>
                        <label><input type="radio" name="istop2" value="1" {{ $data->istop2==1 ? 'checked' : '' }}> 置顶&nbsp;&nbsp;</label>
                    </td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>排序：</label></td>
                    <td class="right"><input type="text" class="field_value" pattern="^\d+$" required name="sort2" value="{{ $data->sort2 }}"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>前台公司页面显示否：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow2" value="0" {{ $data->isshow2==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label>
                        <label><input type="radio" name="isshow2" value="1" {{ $data->isshow2==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label>
                    </td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="companybtn">保存修改</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

