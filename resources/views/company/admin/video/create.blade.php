@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/video" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>视频名称：</label></td>
                    <td class="right"><input type="text" class="field_value" name="name"/></td>
                </tr>

                {{--<tr>--}}
                    {{--<td class="field_name"><label>链接：</label></td>--}}
                    {{--<td class="right"><input type="text" class="field_value" name="url"/></td>--}}
                {{--</tr>--}}

                <tr>
                    <td class="field_name"><label>介绍：</label></td>
                    <td class="right"><textarea name="intro" cols="40" rows="5"></textarea></td>
                </tr>

                <tr>
                    <td class="field_name"><label>上传：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="本地视频地址" disabled name="url_file">
                        <input type="button" class="pic_find" onclick="path.click()" value="[找 图]">
                        <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;" name="url_ori">
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                        <button type="submit" class="companybtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

