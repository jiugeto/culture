@extends('home.main')
@section('content')
    <div class="talk_theme">
        <div class="title">所有话题主题 <span style="float:right;"><a href="/talk">我的话题</a></span></div>
        @if(count($datas))
            @foreach($datas as $data)
            <div class="list">
                <div class="theme">
                    <div>话题标题{{ $data->name }}</div>
                    <div>标题内容{{ $data->intro }}</div>
                    <div class="totheme"><a href="/talk/theme/{{$data->id}}">进入专题</a></div>
                    <div></div>
                </div>
            </div>
            @endforeach
        @else <div class="title">暂无主题</div>
        @endif
        @include('home.common.page')
    </div>
@stop