@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <h3 class="center">{{$lists['func']['name']}}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td class="field_name" style="width:100px;">名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        {{--<tr>--}}
            {{--<td class="field_name">类样式名称：</td>--}}
            {{--<td>{{ $data->style_name }}</td>--}}
        {{--</tr>--}}
        <tr>
            <td class="field_name">产品名称：</td>
            <td>{{ $data->product() }}</td>
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
        <tr>
            <td class="field_name">一级样式：</td>
            <td>
            @if($attrs && isset($attrs['switch']))
                @if($attrs['switch'])
                    启用 &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/member/productattr/{{$data->id}}/1" class="list_btn">查看</a>
                @else 未启用
                @endif
            @else 无
            @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">二级样式：</td>
            <td>
            @if($attrs2 && isset($attrs2['switch2']))
                @if($attrs2['switch2'])
                    启用 &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/member/productattr/{{$data->id}}/2" class="list_btn">查看</a>
                @else 未启用
                @endif
            @else 无
            @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">三级样式：</td>
            <td>
            @if($attrs3 && isset($attrs3['switch3']))
                @if($attrs3['switch3'])
                    启用 &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/member/productattr/{{$data->id}}/3" class="list_btn">查看</a>
                @else 未启用
                @endif
            @else 无
            @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">图片样式：</td>
            <td>
            @if($pics && isset($pics['switch4']))
                @if($pics['switch4'])
                    启用 &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/member/productattr/{{$data->id}}/4" class="list_btn">查看</a>
                @else 未启用
                @endif
            @else 无
            @endif
            </td>
        </tr>
        <tr>
            <td class="field_name">文字样式：</td>
            <td>
            @if($texts && isset($texts['switch5']))
                @if($texts['switch5'])
                    启用 &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/member/productattr/{{$data->id}}/5" class="list_btn">查看</a>
                @else 未启用
                @endif
            @else 无
            @endif
            </td>
        </tr>
    </table>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;回</button>
            </td></tr>
    </table>
@stop

