@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="{{DOMAIN}}company/admin/pic/{{ $data->id }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>图片名称：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/></td>
                </tr>

                <tr>
                    <td class="field_name"><label>介绍：</label></td>
                    <td class="right"><textarea name="intro" cols="40" rows="5">{{ $data->intro }}</textarea></td>
                </tr>

                <tr>
                    <td class="field_name"><label>链接类型：</label></td>
                    <td class="right">
                        <select name="urlSel" required>
                            <option value="1" {{ $data->urlSel==1 ? 'selected' : '' }}>上传的</option>
                            <option value="2" {{ $data->urlSel==2 ? 'selected' : '' }}>外部链接</option>
                        </select>
                        <a class="companybtn" style="font-size:14px;" onclick="upload()">重新上传</a>
                        <a class="companybtn" style="font-size:14px;" onclick="out()">重新填写</a>
                        <a class="companybtn" style="font-size:14px;" href="">重置</a>
                    </td>
                </tr>

                @if($data->url || $data->url2)
                <tr id="hasUrl">
                    <td class="field_name"><label>已有图片：</label></td>
                    <td class="right">
                        @if($data->urlSel==1&&$data->url)
                            {{--<div class="img"><img src="{{ $data->url }}" style="@if($size=$data->getPicSize($data,$w=150,$h=$data->height))width:{{$size}}px;@endif height:{{$data->height}}px;"></div>--}}
                            <div class="img"><img src="{{ $data->url }}" width="500"></div>
                        @elseif($data->urlSel==2&&$data->url2)
                            <div class="img"><img src="{{ $data->url2 }}" width="500"></div>
                        @endif
                    </td>
                </tr>
                @endif

                <tr id="upload" style="display:none;">
                    <td class="field_name"><label>上传(预览)：</label></td>
                    <td class="right">
                        <small class="am-form-help">
                            {{--注意：先添加，再编辑可用图片尺寸。<br>--}}
                            提示：图片尺寸不要大于1M，否则出错。</small>
                        <script src="/assets/js/local_pre.js"></script>
                        <br>
                        <input type="text" class="field_value" placeholder="图片地址" disabled name="url_file">
                        <input type="button" class="pic_find" onclick="path.click()" value="[找 图]">
                        <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">
                        <div id="preview" style="margin: 5px; width: 160px; height: 120px; border:1px dotted #5bc0de ; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>
                    </td>
                </tr>

                <tr id="out" style="display:none;">
                    <td class="field_name"><label>外部链接：</label></td>
                    <td class="right"><input type="text" class="field_value" placeholder="输入外部的链接" name="url2"/></td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返&nbsp; 回</button>
                        <button type="submit" class="companybtn">保存修改</button>
                    </td></tr>
            </table>
        </form>
    </div>

    <script>
        function upload(){
            $("#out").hide(); $("#upload").show();
            $("#hasUrl").hide(); $("select[name='urlSel']")[0].value = 1;
        }
        function out(){
            $("#out").show(); $("#upload").hide();
            $("#hasUrl").hide(); $("select[name='urlSel']")[0].value = 2;
        }

        $("select[name='urlSel']").change(function(){
            if ($(this).val()==1) {
                $("#out").hide(); $("#upload").show();
            } else if ($(this).val()==2) {
                $("#out").show(); $("#upload").hide();
            }
        });
    </script>
@stop

