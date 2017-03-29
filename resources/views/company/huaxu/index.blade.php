@extends('company.main')
@section('content')
    <div class="com_product">
        <div class="com_tab" style="height:20px;">花絮</div>
        <div class="com_list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="javascript:;" onclick="alert('点击看视频！');">
                <div class="com_pro" title="点击开始预览 {{$data['name']}}">
                    <div class="img">
                        <img src="{{$data['thumb']}}">
                    </div>
                    <div class="text">{{$data['name']}}</div>
                </div>
            </a>
                @endforeach
            @endif
            @if(count($datas)<20)
                @for($i=0;$i<20-count($datas);++$i)
                <div class="com_pro">
                    <div class="img">待添加</div>
                    <div class="text">花絮名称</div>
                </div>
                @endfor
            @endif
        </div>
        @include('company.common.page2')
    </div>
@stop