@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        @include('admin.common.menu')
        {{--@include('admin.type.search')--}}
    </div>
    <hr/>

    <div class="am-g">
        @include('admin.common.info')
        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                <tr>
                    <td class="am-hide-sm-only">编号 / Id：</td>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">类型 / Genre：</td>
                    <td>{{ $data->genre() }}</td>
                </tr>
                {{--@if($data->genre==1 && $data->pic_id)--}}
                <tr>
                    <td class="am-hide-sm-only">图片 / Picture：</td>
                    <td>@if($data->pic())<img src="{{ $data->pic()->url }}" class="admin_show_img_size">@endif</td>
                </tr>
                {{--@endif--}}
                {{--@if($data->genre==2 && $data->name)--}}
                <tr>
                    <td class="am-hide-sm-only">文字 / Text：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                {{--@endif--}}

                {{--文字属性开关--}}
                <tr>
                    <td class="am-hide-sm-only switch_pic" colspan="2">文字属性：<a id="open">展 开</a><a id="close" style="display:none;">关 闭</a></td>
                </tr>
                <tr class="text" style="display:none;">
                    <td class="am-hide-sm-only">文字颜色 / Color：</td>
                    <td><div class="admin_yulan" style="float:left;display:{{$data->text['color']?'block':'none'}};"></div></td>
                </tr>
                <tr class="text" style="display:none;">
                    <td class="am-hide-sm-only">文字大小 / Font Size：(单位px)</td>
                    <td>{{ $data->text['font_size'] }}</td>
                </tr>
                <tr class="text" style="display:none;">
                    <td class="am-hide-sm-only">字间距 / Word Space：(单位px)</td>
                    <td>{{ $data->text['word_spacing']?$data->text['word_spacing']:0 }}</td>
                </tr>
                <tr class="text" style="display:none;">
                    <td class="am-hide-sm-only">行高 / Line Height：(单位px)</td>
                    <td>{{ $data->text['line_height']?$data->text['line_height']:0 }}</td>
                </tr>
                <td class="text" style="display:none;">
                    <td class="am-hide-sm-only">水平对齐 / Text Align：</td>
                    <td>{{ $data->textAlign($data->text['text_align']) }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">介绍 / Introduce：</td>
                    <td>{{ $data->intro ? $data->intro : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updated_at!='0000-00-00' ? $data->updated_at : '未修改' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var open = $("#open");
            var close = $("#close");
            var text = $("#text");
            open.click(function(){ open.hide(); close.show(); text.show(); });
            close.click(function(){ close.hide(); open.show(); text.hide(); });
        });
    </script>
@stop