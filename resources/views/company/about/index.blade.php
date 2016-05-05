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
                <a href="{{ $about->small?$about->small:'' }}"><div> ▶ {{ $about->name }}</div></a>
                @endforeach
            @endif
            </div>
        </span>
    </div>
@stop