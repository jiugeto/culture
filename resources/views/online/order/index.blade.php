@extends('online.main')
@section('content')
    <div class="online_list" style="height:900px;background:rgb(40,40,40);">
        @include('online.order.menu')

        <table class="list">
            <tr>
                <td>用户名称</td>
                <td>作品名称</td>
                <td>视频格式</td>
                <td>价格</td>
                <td>状态</td>
                <td>申请时间</td>
                <td width="200">说明</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->uname }}</td>
                <td>{{ $data->getProductName() }}</td>
                <td>{{ $data->getFormatName() }}</td>
                <td>{{ $data->getMoney() }}</td>
                <td>{{ $data->getStatusName() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    @if($data->status==1) {{$datas->total()>10?ceil($datas->total()/10)*24:24}}小时内回应，节假日除外
                    @elseif($data->status==2) {{$data->getStatusName()}}
                    @elseif($data->status==3) {{$datas->total()>10?ceil($datas->total()/10)*48:48}}小时内处理
                    @elseif($data->status==4) 完成
                    @endif
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10" style="text-align:center;">没有记录</td>
            </tr>
        @endif
        </table>
        @if(count($datas)>$datas->limit)<div style="margin-top:20px;">@include('person.common.page')</div>@endif
    </div>
@stop