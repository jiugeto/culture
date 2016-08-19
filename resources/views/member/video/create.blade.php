@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/video" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>视频名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>
            <tr><td colspan="2"><div style="border-bottom:1px dotted lightgrey;"></div></td></tr>

            <tr>
                <td class="field_name"><label>视频地址：</label></td>
                <td>
                    {{--<input type="text" class="field_value" placeholder="视频地址粘贴在这里，至少2个字符" minlegth="2" required name="url"/>--}}
                    <textarea placeholder="视频地址粘贴在这里，至少2个字符" minlegth="2" required name="url" cols="40" rows="5"></textarea>
                    <div style="color:grey;font-size:14px;">
                        视频文件先到上传乐视平台(默认乐视)：不会上传？<a href="/member/video/uploadWay" class="list_btn">点这里</a>
                    </div>
                    {{--<input type="text" class="field_value" placeholder="本地路径" readonly name="url_file" id="url_file">&nbsp;--}}
                    {{--<input type="button" class="upload" value="[找图]" onclick="path.click()">--}}
                    {{--<input type="file" id="path" style="display:none" onchange="url_file.value=this.value" name="url_ori">--}}
                    {{--<div style="color:grey;font-size:14px;">注意：文件尺寸应该小于8M，否则出错</div>--}}
                </td>
            </tr>
            <tr><td colspan="2"><div style="border-bottom:1px dotted lightgrey;"></div></td></tr>

            <tr>
                <td class="field_name"><label>视频宽度：( 单位px)</label></td>
                <td><input type="text" class="field_value" placeholder="必填，1到4个数字" pattern="^([1-9])|([1-9]\d{1,3})$" required name="width" value="640"/></td>
            </tr>
            <tr><td colspan="2"><div style="border-bottom:1px dotted lightgrey;"></div></td></tr>

            <tr>
                <td class="field_name"><label>视频高度：( 单位px)</label></td>
                <td><input type="text" class="field_value" placeholder="必填，1到4个数字" pattern="^([1-9])|([1-9]\d{1,3})$" required name="height" value="480"/></td>
            </tr>
            <tr><td colspan="2"><div style="border-bottom:1px dotted lightgrey;"></div></td></tr>

            {{--@if($user->lecloud)--}}
            <tr>
                <td class="field_name"><label>乐视视频云：</label></td>
                <td>账户： <input type="text" class="field_value" name="lecloud" required value="{{ $user->lecloud }}">
                    <br> 密码： <input type="text" class="field_value" name="lepwd" required value="{{ $user->lepwd }}"></td>
            </tr>
                <tr><td colspan="2"><div style="border-bottom:1px dotted lightgrey;"></div></td></tr>
            {{--@endif--}}

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="40" rows="5"></textarea>
                </td>
            </tr>
            <tr><td colspan="2"><div style="border-bottom:1px dotted lightgrey;"></div></td></tr>

            <tr>
                <td class="field_name"><label>说明：</label></td>
                <td>
                    <div style="color:grey;font-size:14px;">
                        为啥用乐视云？<br>
                        很多人可能用优酷，但是优酷视频不清晰，有优酷logo，播放器也不可调节<br>
                        还可以用七牛、阿里云等等，但是他们收费较高<br>
                        乐视云视频好管理、可以自定义播放器、视频清晰度高，就是操作麻烦些。
                    </div>
                </td>
            </tr>
            <tr><td colspan="2"><div style="border-bottom:1px dotted lightgrey;"></div></td></tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

