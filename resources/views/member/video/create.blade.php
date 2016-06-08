@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/video/upload" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>视频名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>视频地址：</label></td>
                <td>
                    <input type="text" class="field_value" placeholder="视频地址粘贴在这里，至少2个字符" minlegth="2" required name="url"/>
                    <div style="color:grey;font-size:14px;">
                        视频文件先到上传乐视平台：不会上传？<a href="/member/video/uploadWay" class="list_btn">点这里</a>
                    </div>
                    {{--<input type="text" class="field_value" placeholder="本地路径" readonly name="url_file" id="url_file">&nbsp;--}}
                    {{--<input type="button" class="upload" value="[找图]" onclick="path.click()">--}}
                    {{--<input type="file" id="path" style="display:none" onchange="url_file.value=this.value" name="url_ori">--}}
                    {{--<div style="color:grey;font-size:14px;">注意：文件尺寸应该小于8M，否则出错</div>--}}
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            @if($user->lecloud)
            <tr>
                <td class="field_name"><label>乐视视频云：</label></td>
                <td>账户： {{ $user->lecloud }} <br> 密码： {{ $user->lepwd }}</td>
            </tr>
            {{--<tr><td></td></tr>--}}
            @endif

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="40" rows="5"></textarea>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

