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
            <label>样式属性</label>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                <tr>
                    <td class="am-hide-sm-only">编号 / Id：</td>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">样式名称 / Style Name：</td>
                    <td>{{ $data->style_name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">产品名称 / Name：</td>
                    <td>{{ $data->product() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">外边框 / Margin：(单位px)</td>
                    <td>{{ $data->margin }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内边框 / Padding：(单位px)</td>
                    <td>{{ $data->padding }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">宽度 / width：(单位px)</td>
                    <td>{{ $data->width }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">高度 / Height：(单位px)</td>
                    <td>{{ $data->height }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">边框 / Border：</td>
                    <td>{{ $data->border() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字颜色 / Color：</td>
                    <td><div class="admin_yulan" style="{{ $data->color?'background:'.$data->color:'' }}"></div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字尺寸 / Font Size：(单位px)</td>
                    <td>{{ $data->font_size }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字间距 / Word Spacing：(单位px)</td>
                    <td>{{ $data->word_spacing }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">行高 / Line Height：(单位px)</td>
                    <td>{{ $data->line_height }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">字形变换 / Text Transform：</td>
                    <td>{{ $data->textTransform() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字水平位置 / Text Align：</td>
                    <td>{{ $data->textAlign() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">背景色 / Background：</td>
                    <td><div class="admin_yulan" style="{{ $data->background?'background:'.$data->color:'' }}"></div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">定位方式 / Position：</td>
                    <td>{{ $data->position() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">左边距离 / Left：(单位px)</td>
                    <td>{{ $data->left }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">顶部距离 / Top：(单位px)</td>
                    <td>{{ $data->top }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">溢出方式 / Overflow：</td>
                    <td>{{ $data->overflow() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">透明度 / Opacity：</td>
                    <td>{{ $data->opacity }}</td>
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

            <label>图片属性</label>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                @if($picInfo['pic_id'])
                <tr>
                    <td class="am-hide-sm-only">图片预览：</td>
                    <td><img src="{{ $data->pic($picInfo['pic_id']) }}"></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">外边距：(单位px)</td>
                    <td>{{ $picInfo['pic_margin1'] }} - {{ $picInfo['pic_margin2'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内边距：(单位px)</td>
                    <td>{{ $picInfo['pic_padding1'] }} - {{ $picInfo['pic_padding2'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">边框：</td>
                    <td>
                        {{ $data->borderDirection($picInfo['pic_border1']) }} -
                        {{ $picInfo['pic_border2'] }} -
                        {{ $data->borderTypeName($picInfo['pic_border3']) }} -
                        <span style="float:right;">颜色预览：<div class="admin_yulan" style="background:{{ $picInfo['pic_border4'] }};"></div></span>
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">宽度：(单位px)</td>
                    <td>{{ $picInfo['pic_width'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">高度：(单位px)</td>
                    <td>{{ $picInfo['pic_height'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">更新时间：</td>
                    <td>{{ $picInfo['updated_at'] }}</td>
                </tr>
                @else @include('admin.common.norecord')
                @endif
                </tbody>
            </table>

            <label>文字属性</label>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                @if($textInfo['text_con'])
                <tr>
                    <td class="am-hide-sm-only">文字内容：</td>
                    <td>{{ $textInfo['text_con'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">外边距：(单位px)</td>
                    <td>{{ $textInfo['text_margin1'] }} - {{ $textInfo['text_margin2'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内边距：(单位px)</td>
                    <td>{{ $textInfo['text_padding1'] }} - {{ $textInfo['text_padding2'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">边框：</td>
                    <td>
                        {{ $data->borderDirection($textInfo['text_border1']) }} -
                        {{ $textInfo['text_border2'] }} -
                        {{ $data->borderTypeName($textInfo['text_border3']) }} -
                        <span style="float:right;">颜色预览：<div class="admin_yulan" style="background:{{ $textInfo['text_border4'] }};"></div></span>
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">宽度：(单位px)</td>
                    <td>{{ $textInfo['text_font_size'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">高度：(单位px)</td>
                    <td>{{ $textInfo['text_color'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">更新时间：</td>
                    <td>{{ $textInfo['updated_at'] }}</td>
                </tr>
                @else @include('admin.common.norecord')
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop