@extends('home.main')
@section('content')
    <div class="s_crumb">
        <div class="crumb">
            <div class="right">
                <a href="/">首页</a> / 最新活动
            </div>
        </div>
    </div>
    <div class="cre_content">
        {{--周期性免费--}}
        <p class="floor">
            <span class="floor_text2">&nbsp; {{$genres[1]}}</span>
        </p>
        @if(count($datas['activity1']) && $activitys=$datas['activity1'])
            @foreach($activitys as $activity)
                <a href="{{DOMAIN}}active/{{$activity['id']}}/user" title="进入 {{$genres[1]}}">
                    <div class="active">
                        <img src="{{$activity['link']}}" border="0">
                    </div>
                </a>
            @endforeach
        @else
            <a href="javascript:;" title="进入 {{$genres[1]}}">
                <div class="active">
                    <img src="" border="0">
                </div>
            </a>
        @endif
        {{--公益专栏--}}
        <p class="floor">
            <span class="floor_text2">&nbsp; {{$genres[2]}}</span>
        </p>
        @if(count($datas['activity2']) && $activitys=$datas['activity2'])
            @foreach($activitys as $activity)
                <a href="{{DOMAIN}}active/{{$activity['id']}}/user" title="进入 {{$genres[2]}}">
                    <div class="active">
                        <img src="{{$activity['link']}}" border="0">
                    </div>
                </a>
            @endforeach
        @else
            <a href="javascript:;" title="进入 {{$genres[2]}}">
                <div class="active">
                    <img src="" border="0">
                </div>
            </a>
        @endif
        {{--折扣不停--}}
        <p class="floor">
            <span class="floor_text2">&nbsp; {{$genres[3]}}</span>
        </p>
        @if(count($datas['activity3']) && $activitys=$datas['activity3'])
            @foreach($activitys as $activity)
                <a href="{{DOMAIN}}active/{{$activity['id']}}/user" title="进入 {{$genres[3]}}">
                    <div class="active">
                        <img src="{{$activity['link']}}" border="0">
                    </div>
                </a>
            @endforeach
        @else
            <a href="javascript:;" title="进入 {{$genres[3]}}">
                <div class="active">
                    <img src="" border="0">
                </div>
            </a>
        @endif
        {{--套餐优惠--}}
        <p class="floor">
            <span class="floor_text2">&nbsp; {{$genres[4]}}</span>
        </p>
        @if(count($datas['activity4']) && $activitys=$datas['activity4'])
            @foreach($activitys as $activity)
                <a href="{{DOMAIN}}active/{{$activity['id']}}/user" title="进入 {{$genres[4]}}">
                    <div class="active">
                        <img src="{{$activity['link']}}" border="0">
                    </div>
                </a>
            @endforeach
        @else
            <a href="javascript:;" title="进入 {{$genres[4]}}">
                <div class="active">
                    <img src="" border="0">
                </div>
            </a>
        @endif
        {{--分享返利--}}
        <p class="floor">
            <span class="floor_text2">&nbsp; {{$genres[5]}}</span>
        </p>
        @if(count($datas['activity5']) && $activitys=$datas['activity5'])
            @foreach($activitys as $activity)
                <a href="{{DOMAIN}}active/{{$activity['id']}}/user" title="进入 {{$genres[5]}}">
                    <div class="active">
                        <img src="{{$activity['link']}}" border="0">
                    </div>
                </a>
            @endforeach
        @else
            <a href="javascript:;" title="进入 {{$genres[5]}}">
                <div class="active">
                    <img src="" border="0">
                </div>
            </a>
        @endif
        {{--消费返利--}}
        <p class="floor">
            <span class="floor_text2">&nbsp; {{$genres[6]}}</span>
        </p>
        @if(count($datas['activity6']) && $activitys=$datas['activity6'])
            @foreach($activitys as $activity)
                <a href="{{DOMAIN}}active/{{$activity['id']}}/user" title="进入 {{$genres[6]}}">
                    <div class="active">
                        <img src="{{$activity['link']}}" border="0">
                    </div>
                </a>
            @endforeach
        @else
            <a href="javascript:;" title="进入 {{$genres[6]}}">
                <div class="active">
                    <img src="" border="0">
                </div>
            </a>
        @endif
    </div>
@stop