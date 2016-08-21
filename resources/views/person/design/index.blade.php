@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1000px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">视频列表</p>
            <div class="list l_design">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="{{DOMAIN}}person/design/{{ $data->id }}" target="_blank">
                    <div class="per_waterfall">
                        <div class="img">
                            @if($data->getOnePic())
                            <img src="{{ $data->getOnePicUrl() }}" style="@if($size=$data->getUserPicSize($data->getOnePic(),$w=150,$h=200))width:{{$size}}px;@endif height:200px;">
                            @else
                                <div style="width:125px;height:200px;background:rgb(240,240,240);"></div>
                            @endif
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
                            <div style="width:125px;height:200px;background:rgb(240,240,240);"></div>
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