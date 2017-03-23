@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1000px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">设计列表</p>
            <div class="list l_design" style="width:748px;">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="{{DOMAIN}}person/design/{{ $data->id }}">
                    <div class="per_waterfall">
                        <div class="img">
                            @if($data->getPicUrl())
                            <img src="{{ $data->getPicUrl() }}" style="
                                @if($size=$data->getUserPicSize($data->pic(),$w=150,$h=200))
                                    width:{{$size['w']}}px;height:{{$size['h']}}px;
                                @endif
                            ">
                            @else
                                <div style="width:125px;height:200px;background:rgb(240,240,240);"></div>
                            @endif
                        </div>
                        <p class="text">{{ $data->name }}</p>
                    </div>
                </a>
                    @endforeach
                @endif
                {{--@if(count($datas)<$datas->limit)--}}
                    {{--@for($i=0;$i<$datas->limit-count($datas);++$i)--}}
                {{--<a href="">--}}
                    {{--<div class="per_waterfall">--}}
                        {{--<div class="img">--}}
                            {{--<div style="width:125px;height:200px;background:rgb(240,240,240);"></div>--}}
                        {{--</div>--}}
                        {{--<p class="text">暂无</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
                    {{--@endfor--}}
                {{--@endif--}}
                <div style="clear:both;">@include('person.common.page')</div>
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop