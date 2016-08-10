@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <h3 class="center">{{$lists['func']['name']}}{{ in_array($lists['func']['url'],['designPerD','designComD']) ? '需求' : '供应' }}详情页</h3>
    <table class="table_create table_show" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width:100px;">设计名称：</td>
            <td>{{ $data->name }}</td>
        </tr>
        <tr>
            <td>供求关系：</td>
            <td>{{ $data->genreName() }}</td>
        </tr>
        <tr>
            <td>设计类型：</td>
            <td>{{ $data->getCate() }}</td>
        </tr>
        <tr>
            <td>发布者：</td>
            <td>{{ $data->getUserName() }}</td>
        </tr>
        <tr>
            <td>简介：</td>
            <td>{{ $data->intro }}</td>
        </tr>
        <tr>
            <td>详情：</td>
            <td>{!! $data->detail !!}</td>
        </tr>
        <tr>
            <td>价格：</td>
            <td>{{ $data->money() }}</td>
        </tr>
        <tr>
            <td>相册：</td>
            <td>
                @if(count($data->getPics()))
                    @foreach($data->getPics() as $pic)
                        <img src="{{ $pic->url }}">
                    @endforeach
                @else 暂无
                @endif
            </td>
        </tr>
        <tr>
            <td>创建时间：</td>
            <td>{{ $data->createTime() }}</td>
        </tr>
        <tr>
            <td>更新时间：</td>
            <td>{{ $data->updateTime() }}</td>
        </tr>
        <tr><td class="center" colspan="2" style="border:0;cursor:pointer;">
                {{--<a class="list_btn" onclick="history.go(-1)">返回</a>--}}
                <button class="companybtn" onclick="history.go(-1)">返 回</button>
            </td></tr>
    </table>
@stop

