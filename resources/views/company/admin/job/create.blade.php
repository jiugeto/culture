@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/job" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                {{--<tr>--}}
                    {{--<td class="field_name"><label>招聘名称：</label></td>--}}
                    {{--<td class="right"><input type="text" class="field_value" name="name"/></td>--}}
                {{--</tr>--}}
                {{--<tr><td></td></tr>--}}
                {{----}}
                {{--<tr>--}}
                    {{--<td class="field_name"><label>简介：</label></td>--}}
                    {{--<td class="right">--}}
                        {{--<textarea name="intro" cols="50" rows="5"></textarea>--}}
                    {{--</td>--}}
                {{--</tr>--}}
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>工作名称：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="job"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>工作人数：</label></td>
                    <td class="right"><input type="text" class="field_value" pattern="^\D+$" required name="num"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>工作要求：</label></td>
                    <td class="right"><textarea placeholder="至少2个字符" minlength="2" required name="require" cols="40" rows="5"></textarea></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>是否置顶：</label></td>
                    <td class="right">
                        <label><input type="radio" name="istop2" value="0" checked> 不置顶&nbsp;&nbsp;</label>
                        <label><input type="radio" name="istop2" value="1"> 置顶&nbsp;&nbsp;</label>
                    </td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>排序：</label></td>
                    <td class="right"><input type="text" class="field_value" pattern="^\d+$" required name="sort2"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>前台公司页面显示否：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow2" value="0"> 不显示&nbsp;&nbsp;</label>
                        <label><input type="radio" name="isshow2" value="1"> 显示&nbsp;&nbsp;</label>
                    </td>
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

