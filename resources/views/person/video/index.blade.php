@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1000px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">视频列表</p>
            <div class="list l_pic">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="{{DOMAIN}}person/video/pre/{{ $data->id }}" target="_blank">
                    <div class="per_waterfall">
                        <div class="img">
                            <img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getUserPicSize($data->getPic(),$w=148,$h=100))width:{{$size}}px;@endif height:120px;">
                        </div>
                        <p class="text">{{ $data->name }}</p>
                    </div>
                </a>
                    @endforeach
                @endif
                @if(count($datas)<$datas->limit)
                    @for($i=0;$i<$datas->limit-count($datas);++$i)
                <a href="">
                    <div class="per_waterfall">
                        <div class="img">
                            <div style="width:220px;height:120px;background:rgb(240,240,240);"></div>
                        </div>
                        <p class="text">暂无</p>
                    </div>
                </a>
                    @endfor
                @endif
                    
                @include('person.common.page')
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop