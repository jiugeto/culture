@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="/company/admin/info" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>{{ $type?$types[$type]:'信息' }}名称：</label></td>
                    <td class="right"><input type="text" class="field_value" name="name"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>{{--{{ $type?$types[$type]:'信息' }}--}}信息类型：</label></td>
                    <td class="right">
                        @if($type) {{ $types[$type] }}
                        @else
                        <select name="type" required>
                            @foreach($types as $ktype=>$vtype)
                                @if($ktype!=1)
                                <option value="{{ $ktype }}">{{ $vtype }}</option>
                                @endif
                            @endforeach
                        </select>
                        @endif
                    </td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>内容：</label></td>
                    {{--<td class="right"><textarea name="require" cols="40" rows="5"></textarea></td>--}}
                    <td class="right" style="position:relative;z-index:0;">
                        @include('UEditor::head')
                        <script id="container" name="intro" type="text/plain"></script>
                        <script type="text/javascript">
                            var ue = UE.getEditor('container',{
                                initialFrameWidth:400,
                                initialFrameHeight:100,
                                toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','imagefloat','insertimage','searchreplace','pasteplain','help','fullscreen']]
                            });
                            ue.ready(function() {
                                //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                            });
                        </script>
                    </td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>{{ $type?$types[$type]:'信息' }}(最多6张)：</label></td>
                    <td class="right">
                        图片(第1张)：
                        <select name="pic">
                            <option value="0">选择图片</option>
                            @if($pics)
                            @foreach($pics as $pic)
                                <option value="{{ $pic->id }}">{{ $pic->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <input type="hidden" name="numPic" value="1">
                        <span id="more"></span>
                        <br><br> <a class="list_btn" id="add">更多图片</a><br><br>
                        <script>
                            $(document).ready(function(){
                                $("#add").click(function(){
                                    var numPic = $("input[name='numPic']");
                                    var picHtml = '';
                                    numPic[0].value = numPic.val()*1+1;
                                    if(numPic.val()>6){ alert('图片限制6张！');return false; }
                                    picHtml += '<br>图片(第'+numPic.val()+'张)： ';
                                    picHtml += '<select name="pic_id'+numPic.val()+'">';
                                    picHtml += '<option value="">选择图片</option>';
                                    picHtml += '@if($pics)';
                                    picHtml += '@foreach($pics as $kpic=>$pic)';
                                    picHtml += '<option value="{{ $kpic }}">{{ $pic->name }}</option>';
                                    picHtml += '@endforeach';
                                    picHtml += '@endif';
                                    picHtml += '</select>';
                                    picHtml += '';
                                    $("#more").append(picHtml);
                                });
                            });
                        </script>
                    </td>
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
                    <td class="right"><input type="text" class="field_value" name="sort2" value="10"/></td>
                </tr>
                {{--<tr><td></td></tr>--}}

                <tr>
                    <td class="field_name"><label>前台是否显示：</label></td>
                    <td class="right">
                        <label><input type="radio" name="isshow2" value="0" checked> 不显示&nbsp;&nbsp;</label>
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

