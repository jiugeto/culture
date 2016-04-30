@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/pic/{{ $data->id }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>图片名称：</label></td>
                    <td class="right"><input type="text" class="field_value" name="name" value="{{ $data->name }}"/></td>
                </tr>

                {{--<tr>--}}
                    {{--<td class="field_name"><label>链接：</label></td>--}}
                    {{--<td class="right"><input type="text" class="field_value" name="url"/></td>--}}
                {{--</tr>--}}

                <tr>
                    <td class="field_name"><label>介绍：</label></td>
                    <td class="right"><textarea name="intro" cols="40" rows="5">{{ $data->intro }}</textarea></td>
                </tr>

                <tr>
                    <td class="field_name"><label>上传(预览)：</label></td>
                    <td class="right">
                        <img src="{{ $data->url }}">
                        {{--<small class="am-form-help">注意：先添加，再编辑可用图片尺寸。<br>--}}
                            {{--提示：图片尺寸不要大于1M，否则出错。</small>--}}
                        {{--<script src="/assets/js/local_pre.js"></script>--}}
                        {{--<br>--}}
                        {{--<input type="text" class="field_value" placeholder="本地图片地址" disabled name="url_file">--}}
                        {{--<input type="button" class="pic_find" onclick="path.click()" value="[找 图]">--}}
                        {{--<input type="file" id="path" style="display:none" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">--}}
                        {{--<div id="preview" style="margin: 5px; width: 160px; height: 120px; border:1px dotted #5bc0de ; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>--}}
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

