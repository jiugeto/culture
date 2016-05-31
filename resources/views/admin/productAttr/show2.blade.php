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
                    <td class="am-hide-sm-only" style="width:200px;"><b>@if($index==1)一级@elseif($index==2)二级@elseif($index==3)三级@elseif($index==4)图片@elseif($index==5)文字@endif样式</b></td>
                    <td></td>
                </tr>
                @if(($index==1 && $attrs['switch']) || ($index>1 && $attrs['switch'.$index]))
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
                    <td>{{ $attrs['width'] ? $attrs['width'] : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">高度 / Height：(单位px)</td>
                    <td>{{ $attrs['height'] ? $attrs['height'] : '' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">边框 / Border：</td>
                    <td>
                        @if($attrs['border1']==0) 无
                        @elseif($attrs['border1'])
                            {{ $model->borderDirection($attrs['border1']) }}
                            {{ $attrs['border2'] }} {{ $model->borderTypeName($attrs['border3']) }} {{ $attrs['border4'] }}
                            <br>颜色 <div class="admin_yulan" style="{{$attrs['border4']?'background:'.$attrs['border4']:''}}"></div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">溢出方式 / Overflow：</td>
                    <td>{{ $model->overflowName($attrs['overflow']) }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">透明度 / Opacity：</td>
                    <td>{{ $attrs['opacity'] ? $attrs['opacity'] : '无' }}</td>
                </tr>
                @if(in_array($index,[1,2,3,5]))
                <tr>
                    <td class="am-hide-sm-only">颜色 / Color：</td>
                    <td>
                        @if($attrs['iscolor'])
                            <div class="admin_yulan" style="{{ $attrs['color']?'color:'.$attrs['color']:'' }}"></div>
                        @else 无
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字尺寸 / Font Size：(单位px)</td>
                    <td>{{ $attrs['font_size'] ?$attrs['font_size'] : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字间距 / Word Spacing：(单位px)</td>
                    <td>{{ $attrs['word_spacing'] ? $attrs['word_spacing'] : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">行高 / Line Height：(单位px)</td>
                    <td>{{ $attrs['line_height'] ? $attrs['line_height'] : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">字形变换 / Text Transform：(单位px)</td>
                    <td>{{ $model->textTransformName($attrs['text_transform']) }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">字的水平对齐方式 / Text Align：(单位px)</td>
                    <td>{{ $model->textAlignName($attrs['text_align']) }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">背景色 / Background：</td>
                    <td>
                        @if($attrs['isbackground'])
                            <div class="admin_yulan" style="{{ $attrs['background']?'background:'.$attrs['background']:'' }}"></div>
                        @else 无
                        @endif
                    </td>
                </tr>
                @endif
                <tr>
                    <td class="am-hide-sm-only">定位方式 / Position：</td>
                    <td>{{ $model->positionName($attrs['position']) }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">左边距离 / Left：(单位px)</td>
                    <td>{{ $attrs['left'] ?$attrs['left'] : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">顶部距离 / Top：(单位px)</td>
                    <td>{{ $attrs['top'] ? $attrs['top'] : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">浮动方式 / Float：</td>
                    <td>@if(isset($attrs['float'])){{ $model->floatTypeName($attrs['float']) }}@endif</td>
                </tr>
                @else @include('admin.common.norecord')
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop