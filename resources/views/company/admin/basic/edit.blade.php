@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/basic/{{ $data->id }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>公司logo：</label></td>
                    <td class="right">
                    @if($data->logo)
                        <img src="{{ $data->logo }}" style="border:1px solid lightgrey;height:50px;"><br>
                        <input type="text" class="field_value" placeholder="本地图片地址" disabled name="url_file">
                        <input type="button" class="pic_find" onclick="path.click()" value="[重新上传]">
                        <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;" name="url_ori">
                    @else
                        <input type="text" class="field_value" placeholder="本地图片地址" disabled name="url_file">
                        <input type="button" class="pic_find" onclick="path.click()" value="[找 图]">
                        <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">
                        <div id="preview" style="margin: 5px; width: 160px; height: 120px; border:1px dotted #5bc0de ; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>
                    @endif
                        <script src="/assets/js/local_pre.js"></script>
                        <br><small class="am-form-help">注意：图片尺寸不宜过大，150*50范围内。</small>
                    </td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>鼠标移动显示：</label></td>
                    <td class="right"><input type="text" class="field_value" name="title" value="{{ $data->title }}"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>网站关键字：</label></td>
                    <td class="right"><input type="text" class="field_value" name="keyword" value="{{ $data->keyword }}"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>网站描述：</label></td>
                    <td class="right">
                        <textarea name="description" cols="40" rows="5">{{ $data->description }}</textarea>
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

