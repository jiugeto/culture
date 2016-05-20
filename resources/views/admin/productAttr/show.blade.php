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
            <label>总的样式属性</label>
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
                @if($attrs['switch0'])
                <tr>
                    <td class="am-hide-sm-only">外边框 / Margin：(单位px)</td>
                    <td>
                        @if($attrs['ismargin']==1) 无
                        @elseif($attrs['ismargin']==2) 上下左右自动
                        @elseif($attrs['ismargin']==3) 上下自动，左右{{ $attrs['margin2'] }}
                        @elseif($attrs['ismargin']==4) 上下自动，左右{{ $attrs['margin1'] }}
                        @elseif($attrs['ismargin']==5)
                            上{{ $attrs['margin3'] }}，下{{ $attrs['margin4'] }}，
                            左{{ $attrs['margin5'] }}，右{{ $attrs['margin6'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内边框 / Padding：(单位px)</td>
                    <td>
                        @if($attrs['ispadding']==1) 无
                        @elseif($attrs['ispadding']==2) 上下左右自动
                        @elseif($attrs['ispadding']==3) 上下自动，左右{{ $attrs['padding2'] }}
                        @elseif($attrs['ispadding']==4) 上下自动，左右{{ $attrs['padding1'] }}
                        @elseif($attrs['ispadding']==5)
                            上{{ $attrs['padding3'] }}，下{{ $attrs['padding4'] }}，
                            左{{ $attrs['padding5'] }}，右{{ $attrs['padding6'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">宽度 / width：(单位px)</td>
                    <td>{{ $attrs['width'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">高度 / Height：(单位px)</td>
                    <td>{{ $attrs['height'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">边框 / Border：</td>
                    <td>
                        @if($attrs['border1']==0) 无
                        @elseif($attrs['border1'])
                            {{ $model->borderDirection($attrs['border1']) }}
                            {{ $attrs['border2'] }} {{ $model->borderTypeName($attrs['border3']) }} {{ $attrs['border4'] }}
                        @endif
                        <br>颜色 <div class="admin_yulan" style="{{$attrs['border4']?'background:'.$attrs['border4']:''}}"></div>
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">背景色 / Background：</td>
                    <td><div class="admin_yulan" style="{{ $attrs['background']?'background:'.$attrs['color']:'' }}"></div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">定位方式 / Position：</td>
                    <td>{{ $model->positionName($attrs['position']) }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">左边距离 / Left：(单位px)</td>
                    <td>{{ $attrs['left'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">顶部距离 / Top：(单位px)</td>
                    <td>{{ $attrs['top'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">溢出方式 / Overflow：</td>
                    <td>{{ $model->overflowName($attrs['overflow']) }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">透明度 / Opacity：</td>
                    <td>{{ $attrs['opacity'] }}</td>
                </tr>
                @else @include('admin.common.norecord')
                @endif
                </tbody>
            </table>
            <label>文字样式属性</label>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                @if($textAttr)
                <tr>
                    <td class="am-hide-sm-only">文字属性开关：</td>
                    <td>{{ $textAttr['switch1'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">外边框 / Margin：(单位px)</td>
                    <td>
                        @if($textAttr['istextmargin']==1) 无
                        @elseif($textAttr['istextmargin']==2) 上下左右自动
                        @elseif($textAttr['istextmargin']==3) 上下自动，左右{{ $textAttr['textmargin2'] }}
                        @elseif($textAttr['istextmargin']==4) 上下自动，左右{{ $textAttr['textmargin1'] }}
                        @elseif($textAttr['istextmargin']==5)
                            上{{ $textAttr['textmargin3'] }}，下{{ $textAttr['textmargin4'] }}，
                            左{{ $textAttr['textmargin5'] }}，右{{ $textAttr['textmargin6'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内边框 / Padding：(单位px)</td>
                    <td>
                        @if($textAttr['istextpadding']==1) 无
                        @elseif($textAttr['istextpadding']==2) 上下左右自动
                        @elseif($textAttr['istextpadding']==3) 上下自动，左右{{ $textAttr['textpadding2'] }}
                        @elseif($textAttr['istextpadding']==4) 上下自动，左右{{ $textAttr['textpadding1'] }}
                        @elseif($textAttr['istextpadding']==5)
                            上{{ $textAttr['textpadding3'] }}，下{{ $textAttr['textpadding4'] }}，
                            左{{ $textAttr['textpadding5'] }}，右{{ $textAttr['textpadding6'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">边框 / Border：</td>
                    <td>
                        @if($textAttr['textborder1']==0) 无
                        @elseif($textAttr['textborder1'])
                            {{ $model->borderDirection($textAttr['textborder1']) }}
                            {{ $textAttr['textborder2'] }} {{ $model->borderTypeName($textAttr['textborder3']) }} {{ $textAttr['textborder4'] }}
                        @endif
                        <br>颜色 <div class="admin_yulan" style="{{$textAttr['textborder4']?'background:'.$textAttr['textborder4']:''}}"></div>
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字颜色 / Color：</td>
                    <td><div class="admin_yulan" style="{{ $textAttr['textcolor']?'background:'.$textAttr['textcolor']:'' }}"></div></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字尺寸 / Font Size：(单位px)</td>
                    <td>{{ $textAttr['text_font_size'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字间距 / Word Spacing：(单位px)</td>
                    <td>{{ $textAttr['text_word_spacing'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">行高 / Line Height：(单位px)</td>
                    <td>{{ $textAttr['text_line_height'] }}</td>
                </tr>
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">字形变换 / Text Transform：</td>--}}
                    {{--<td>{{ $model->textTransformName($textAttr['text_transform']) }}</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">文字水平位置 / Text Align：</td>--}}
                    {{--<td>{{ $model->textAlignName($textAttr['text_align']) }}</td>--}}
                {{--</tr>--}}
                @else @include('admin.common.norecord')
                @endif
                </tbody>
            </table>
            <label>图片样式属性</label>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                @if($picAttr)
                <tr>
                    <td class="am-hide-sm-only">图片属性开关：</td>
                    <td>{{ $picAttr['switch2'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">外边框 / Margin：(单位px)</td>
                    <td>
                        @if($picAttr['ispicmargin']==1) 无
                        @elseif($picAttr['ispicmargin']==2) 上下左右自动
                        @elseif($picAttr['ispicmargin']==3) 上下自动，左右{{ $picAttr['picmargin2'] }}
                        @elseif($picAttr['ispicmargin']==4) 上下自动，左右{{ $picAttr['picmargin1'] }}
                        @elseif($picAttr['ispicmargin']==5)
                            上{{ $picAttr['picmargin3'] }}，下{{ $picAttr['picmargin4'] }}，
                            左{{ $picAttr['picmargin5'] }}，右{{ $picAttr['picmargin6'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内边框 / Padding：(单位px)</td>
                    <td>
                        @if($picAttr['ispicpadding']==1) 无
                        @elseif($picAttr['ispicpadding']==2) 上下左右自动
                        @elseif($picAttr['ispicpadding']==3) 上下自动，左右{{ $picAttr['picpadding2'] }}
                        @elseif($picAttr['ispicpadding']==4) 上下自动，左右{{ $picAttr['picpadding1'] }}
                        @elseif($picAttr['ispicpadding']==5)
                            上{{ $picAttr['picpadding3'] }}，下{{ $picAttr['picpadding4'] }}，
                            左{{ $picAttr['picpadding5'] }}，右{{ $picAttr['picpadding6'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">边框 / Border：</td>
                    <td>
                        @if($picAttr['picborder1']==0) 无
                        @elseif($picAttr['picborder1'])
                            {{ $model->borderDirection($picAttr['picborder1']) }}
                            {{ $picAttr['picborder2'] }} {{ $model->borderTypeName($picAttr['picborder3']) }} {{ $picAttr['picborder4'] }}
                        @endif
                        <br>颜色 <div class="admin_yulan" style="{{$picAttr['picborder4']?'background:'.$picAttr['picborder4']:''}}"></div>
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">宽度 / Width：</td>
                    <td>{{ $picAttr['picwidth'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">高度 / Height：</td>
                    <td>{{ $picAttr['picheight'] }}</td>
                </tr>
                @else @include('admin.common.norecord')
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop