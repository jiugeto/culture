@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/pic" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            <tr>
                <td class="field_name"><label>图片名称：</label></td>
                <td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>
            </tr>
            <tr><td></td></tr>

            {{--<tr>--}}
                {{--<td class="field_name"><label>分类：</label></td>--}}
                {{--<td>--}}
                    {{--<select name="cate_id">--}}
                        {{--<option value="0">-请选择-</option>--}}
                        {{--@foreach($categorys as $category)--}}
                            {{--<option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                            {{--@if($category->child)--}}
                                {{--@foreach($category->child as $subcate)--}}
                                    {{--<option value="{{ $subcate->id }}">{{ '&nbsp;=='.$subcate->name }}</option>--}}
                                    {{--@if($subcate->child)--}}
                                        {{--@foreach($subcate->child as $subcate2)--}}
                                            {{--<option value="{{ $subcate2->id }}">--}}
                                                {{--{{ '&nbsp;&nbsp;&nbsp;&nbsp;=='.$subcate2->name }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>图片地址：</label></td>
                <td>
                    <button type="button" class="companybtn" onclick="$('#url_file').toggle();$('#url').toggle();">上传图片</button>
                    <button type="button" class="companybtn" onclick="$('#url_file').toggle();$('#url').toggle();">填写网站</button>
                    <span id="url_file">
                        <script type="text/javascript" src="{{DOMAIN}}assets/js/local_pre.js"></script>
                        <div class="col-xs-3 duiqi-left">
                            <input type="text" placeholder="图片地址" name="url_file">
                            <input type="button" value="[找图]" onclick="path.click()"
                                   style="margin:2px;padding:2px 10px;border:1px solid red;background:red;color:white;">
                            <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">
                            <div id="preview" style="margin:5px;width:160px;height:120px;border:1px dotted #5bc0de;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>
                            <br><small class="am-form-help">提示：不要大于5M，否则出错
                                <br>支持文件格式：png，jpg，gif，bmp，jpeg，jpe</small>
                        </div>
                    </span>
                    <span id="url" style="display:none;">
                        <input type="text" class="field_value" placeholder="数字，至少2个字符" minlegth="2" required name="url"/>
                    </span>
                </td>
            </tr>
            <tr><td></td></tr>

            <tr>
                <td class="field_name"><label>简介：</label></td>
                <td>
                    <textarea name="intro" cols="40" rows="5"></textarea>
                    {{--@include('UEditor::head')
                    <script id="container" name="content" type="text/plain"></script>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container',{
                            initialFrameWidth:500,
                            initialFrameHeight:100,
//                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','searchreplace','pasteplain','help']]
                        });
                        ue.ready(function() {
                            //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                        });
                    </script>--}}
                </td>
            </tr>
            <tr><td></td></tr>

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

