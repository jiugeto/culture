@extends('company.main')
@section('content')
    <div class="com_about">
        <span class="left">
            <div class="about_con">
                <div class="star">{{ $data->name }}</div>
                <div class="con">{!! $data->intro !!}</div>
            </div>
        </span>
        <span class="right">
            <div class="about_a">
            @if(count($abouts))
                @foreach($abouts as $about)
                {{--<a href=""><div> ▶ 简介</div></a>--}}
                    @if($about->type==1)
                <a href="/company/about"><div> ▶ {{ $about->name }}</div></a>
                    @else
                <a href="/company/{{$about->type}}/about"><div> ▶ {{ $about->name }}</div></a>
                    @endif
                @endforeach
            @endif
            </div>
        </span>
    </div>
@stop