@extends('company.main')
@section('content')
    <div class="com_firm">
        {{--<div class="title"><div>公司的团队</div></div>--}}
        {{--<p>团队的简单介绍...</p>--}}
        <div class="title"><div>{{ $team?$team->name:'无' }}</div></div>
        <p>{!! $team?$team->intro:'无' !!}</p>
        <div class="com_team_con">
            {{--<span>--}}
                {{--<div class="onlyone">--}}
                    {{--<div><img src="/uploads/images/2016/online1.png"></div>--}}
                {{--</div>--}}
            {{--</span>--}}
            @if(count($datas))
                @foreach($datas as $data)
            <span>
                <div class="onlyone">
                    <div class="img"><a href="/company/team/{{$data->id}}"><img src="{{$data->pic_id?$data->pic()->url:''}}"></a></div>
                    <p><a href="/company/team/{{$data->id}}" class="com_a_show">{{ $data->name }}</a></p>
                </div>
                {{--<div>{{ strip_tags($data->intro) }}</div>--}}
            </span>
                @endforeach
            @endif
        </div>
    </div>
@stop