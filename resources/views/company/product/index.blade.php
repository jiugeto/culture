@extends('company.main')
@section('content')
    <div class="com_product">
        {{--<p class="crumb"><b>导航：</b>产品类别 > 视频 > 宣传片</p>--}}
        <p class="com_tab">
            <span><b>{{$curr=='product'?'产品':'花絮'}}标签：</b></span>
            <input type="hidden" name="curr" value="{{ $curr }}">
            @foreach($model['cates2'] as $kcate=>$cate)
                <a onclick="">{{ $cate }}</a>
            @endforeach
        </p>
        <div class="com_list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="">
                <div class="com_pro">
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
            <a href="">
                <div class="com_pro">
                    <div class="img">待添加</div>
                    <div class="text">视频名称</div>
                </div>
            </a>
                @endfor
            @endif
        </div>
        @include('company.partials.page')
    </div>
@stop