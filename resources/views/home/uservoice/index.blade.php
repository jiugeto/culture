@extends('home.main')
@section('content')
    {{--@include('home.common.crumb')--}}
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="{{DOMAIN}}uservoice/create">发布新的心声</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="/">首页</a> / 用户心声
            </div>
        </div>
    </div>

    <div class="opinion_con">
        <div class="opinion_list">
            @if(count($datas)>1)
                @foreach($datas as $kdata=>$data)
                    @if(is_numeric($kdata))
            <table class="record">
                <tr>
                    <td class="text">标题：{{ $data['name'] }}</td>
                    <td class="text">用户：{{ $data['username'] }}</td>
                    <td class="text" style="width:300px;font-size:14px;">时间：{{ $data['createTime'] }}</td>
                    <td class="detail">
                        <a href="{{DOMAIN}}uservoice/{{$data['id']}}" style="float:right;">查看</a>
                    </td>
                </tr>
            </table>
                    @endif
                @endforeach
            @else
            <table class="record">
                <tr><td colspan="10" class="center">没有记录</td></tr>
            </table>
            @endif

            @include('home.common.page2')
        </div>
    </div>
@stop