@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td class="field_name">类样式名称：</td>
            <td>{{ $data->style_name }}</td>
        </tr>
        <tr>
            <td class="field_name">产品名称：</td>
            <td>{{ $data->product() }}</td>
        </tr>
        <tr>
            <td class="field_name">外边距：</td>
            <td>
                @if($attrs['ismargin']==1) 无
                @elseif($attrs['ismargin']==2) 上下左右居中
                @elseif($attrs['ismargin']==3) 上下居中，左右{{ $attrs['margin2'] }}
                @elseif($attrs['ismargin']==4) 左右居中，上下{{ $attrs['margin1'] }}
                @elseif($attrs['ismargin']==5)
                    上{{ $attrs['margin3'] }}，下{{ $attrs['margin4'] }}，
                    左{{ $attrs['margin5'] }}，右{{ $attrs['margin6'] }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">边距：</td>
            <td>
                @if($attrs['ispadding']==1) 无
                @elseif($attrs['ispadding']==2) 上下左右居中
                @elseif($attrs['ispadding']==3) 上下居中，左右{{ $attrs['padding2'] }}
                @elseif($attrs['ispadding']==4) 左右居中，上下{{ $attrs['padding1'] }}
                @elseif($attrs['ispadding']==5)
                    上{{ $attrs['padding3'] }}，下{{ $attrs['padding4'] }}，
                    左{{ $attrs['padding5'] }}，右{{ $attrs['padding6'] }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">宽度：</td>
            <td>{{ $attrs['width'] }}</td>
        </tr>
        <tr>
            <td class="field_name">高度：</td>
            <td>{{ $attrs['height'] }}</td>
        </tr>
        <tr>
            <td class="field_name">简介：</td>
            <td>{{ $data->intro ? $data->intro : '无' }}</td>
        </tr>
        <tr>
            <td class="field_name">创建时间：</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td class="field_name">更新时间：</td>
            <td>{{ $data->updated_at!='0000-00-00 00:00:00' ? $data->updated_at : '未更新' }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

