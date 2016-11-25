@extends('company.main')
@section('content')
    <div class="com_product">
        {{--<p class="crumb"><b>导航：</b>产品类别 > 视频 > 宣传片</p>--}}
        <div class="com_tab">
            <b style="float:left;">{{$curr=='product'?'样片':'花絮'}}类型：</b>
            <input type="hidden" name="curr" value="{{ $curr }}">

            <div onclick="window.location.href='{{DOMAIN}}c/{{CID}}/{{$curr}}';"
                 class="{{ $cate==0 ? 'curr' : 'link' }}">所有类型</div>

            @foreach($model['cates2'] as $kcate=>$vcate)
                <div onclick="window.location.href='{{DOMAIN}}c/{{CID}}/{{$curr}}/{{$kcate}}';"
                   class="{{ $cate==$kcate ? 'curr' : 'link' }}">{{ $vcate }}</div>
            @endforeach
        </div>
        <div class="com_list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="{{DOMAIN}}c/{{CID}}/video/{{$data->id}}/{{$data->video_id}}" target="_blank">
                <div class="com_pro" title="点击开始预览 {{ $data->name }}">
                    <div class="img">
                        <img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getPicSize($w=228,$h=120))width:{{$size['w']}}px;height:{{$size['h']}}px; @endif">
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