@extends('company.main')
@section('content')
    <div class="com_product">
        {{--<p class="crumb"><b>导航：</b>产品类别 > 视频 > 宣传片</p>--}}
        <p class="com_tab">
            <span><b>{{$curr=='product'?'样片':'花絮'}}类型：</b></span>
            <input type="hidden" name="curr" value="{{ $curr }}">

            <a onclick="window.location.href='{{DOMAIN}}c/{{CID}}/{{$curr}}';" class="{{ $cate==0 ? 'curr' : '' }}">所有</a>
            @foreach($model['cates2'] as $kcate=>$vcate)
                <a onclick="window.location.href='{{DOMAIN}}c/{{CID}}/{{$curr}}/{{$kcate}}';"
                   class="{{ $cate==$kcate ? 'curr' : '' }}">{{ $vcate }}</a>
            @endforeach
        </p>
        <div class="com_list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="{{DOMAIN}}c/{{CID}}/video/{{$data->id}}/{{$data->video_id}}" target="_blank">
                <div class="com_pro" title="点击开始预览 {{ $data->name }}">
                    <div class="img">
                        <img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getPicSize($w=228,$h=120))width:{{$size}}px;height:120px; @endif">
                    </div>
                    <div class="text">{{ $data->name }}</div>
                </div>
            </a>
                @endforeach
            @endif
            @if(count($datas)<$datas->limit)
                @for($i=0;$i<$datas->limit-count($datas);++$i)
                <div class="com_pro">
                    <div class="img">待添加</div>
                    <div class="text">视频名称</div>
                </div>
                @endfor
            @endif
        </div>
        @include('company.partials.page')
    </div>
@stop