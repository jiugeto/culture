@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1000px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">视频列表</p>
            <div class="list l_pic" style="width:748px">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="{{DOMAIN}}person/video/pre/{{$data['id']}}" target="_blank">
                    <div class="per_waterfall">
                        <div class="img">
                            <img src="{{$data['thumb']}}">
                        </div>
                        <p class="text">{{$data['name']}}</p>
                    </div>
                </a>
                    @endforeach
                @endif
                @include('person.common.page2')
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop