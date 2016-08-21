@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1000px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">作品列表</p>
            <div class="list l_pic">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="{{DOMAIN}}person/product/pre/{{ $data->id }}" target="_blank">
                    <div class="per_waterfall">
                        <div class="img">
                        @if($data->getPic())
                            <img src="{{ $data->getPicUrl() }}" style="
                            @if($size=$data->getUserPicSize($data->getPic(),$w=148,$h=100))
                                    width:{{$size}}px;
                            @endif
                                    height:120px;
                        ">
                        @else
                            <div style="width:220px;height:120px;background:rgb(240,240,240);"></div>
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
                            <div style="width:220px;height:120px;color:lightgrey;text-align:center;line-height:100px;background:rgb(240,240,240);">无</div>
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