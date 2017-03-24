@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1000px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">作品列表</p>
            <div class="list l_pic">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="{{DOMAIN}}person/product/pre/{{$data['id']}}" target="_blank">
                    <div class="per_waterfall">
                        <div class="img">
                        @if($data['thumb'])<img src="{{$data['thumb']}}">@endif
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