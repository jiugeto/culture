@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1000px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">设计列表</p>
            <div class="list l_design" style="width:748px;">
                @if(count($datas))
                    @foreach($datas as $data)
                <a href="{{DOMAIN}}person/design/{{$data['id']}}">
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