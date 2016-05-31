@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name"></td>
            <td><b>@if($index==1)一级@elseif($index==2)二级@elseif($index==3)三级@elseif($index==4)图片@elseif($index==5)文字@endif样式</b></td>
        </tr>
        @if($attrs['switch'.$index==1?'':$index])
        <tr>
            <td class="field_name">外边距：</td>
            <td>
                @if($attrs['ismargin']==1) 无
                @elseif($attrs['ismargin']==2) 上下左右居中
                @elseif($attrs['ismargin']==3) 上下居中，左右{{ $attrs['margin2'] }}px
                @elseif($attrs['ismargin']==4) 左右居中，上下{{ $attrs['margin1'] }}px
                @elseif($attrs['ismargin']==5)
                    上{{ $attrs['margin3'] }}px，下{{ $attrs['margin4'] }}px，
                    左{{ $attrs['margin5'] }}px，右{{ $attrs['margin6'] }}px
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">内边距：</td>
            <td>
                @if($attrs['ispadding']==1) 无
                @elseif($attrs['ispadding']==2) 上下左右居中
                @elseif($attrs['ispadding']==3) 上下居中，左右{{ $attrs['padding2'] }}px
                @elseif($attrs['ispadding']==4) 左右居中，上下{{ $attrs['padding1'] }}px
                @elseif($attrs['ispadding']==5)
                    上{{ $attrs['padding3'] }}px，下{{ $attrs['padding4'] }}px，
                    左{{ $attrs['padding5'] }}px，右{{ $attrs['padding6'] }}px
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">边框：</td>
            <td>
                @if($attrs['border1']==0) 无
                @elseif($attrs['border1']>0)
                    {{ $data->borderDirection($attrs['border1']).'，'.$attrs['border2'].'px，'.$data->borderTypeName($attrs['border3']).'，'.$attrs['border4'] }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">宽度：</td>
            <td>{{ $attrs['width'] }}</td>
        </tr>
        <tr>
            <td class="field_name">高度：</td>
            <td>{{ $attrs['height'] }}px</td>
        </tr>
        <tr>
            <td class="field_name">定位方式：</td>
            <td>{{ $data->positionTypeName($attrs['position']) }}</td>
        </tr>
        <tr>
            <td class="field_name">左边距离：</td>
            <td>{{ $attrs['left'] }}px</td>
        </tr>
        <tr>
            <td class="field_name">顶部距离：</td>
            <td>{{ $attrs['top'] }}px</td>
        </tr>
        <tr>
            <td class="field_name">裁剪方式：</td>
            <td>{{ $data->overflowName($attrs['overflow']) }}</td>
        </tr>
        <tr>
            <td class="field_name">透明度：</td>
            <td>{{ $attrs['opacity'] }}</td>
        </tr>
        @if(in_array($index,[1,2,3,5]))
        <tr>
            <td class="field_name">颜色：</td>
            <td>{{ $attrs['iscolor'] ? $attrs['color'] : '无' }}</td>
        </tr>
        <tr>
            <td class="field_name">文字大小：</td>
            <td>{{ $attrs['font_size'] }}px</td>
        </tr>
        <tr>
            <td class="field_name">字间距：</td>
            <td>{{ $attrs['word_spacing'] }}px</td>
        </tr>
        <tr>
            <td class="field_name">行高：</td>
            <td>{{ $attrs['line_height'] }}px</td>
        </tr>
        <tr>
            <td class="field_name">字体变换：</td>
            <td>{{ $data->textTransformName($attrs['text_transform']) }}</td>
        </tr>
        <tr>
            <td class="field_name">水平对齐方式：</td>
            <td>{{ $data->textAlignName($attrs['text_align']) }}</td>
        </tr>
        <tr>
            <td class="field_name">背景色：</td>
            <td>{{ $attrs['isbackground'] ? $attrs['background'] : '无' }}</td>
        </tr>
        @endif
        @else @include('member.common.norecord')
        @endif
    </table>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

