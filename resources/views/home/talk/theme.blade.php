@extends('home.main')
@section('content')
    <div class="talk_theme">
        <div class="title">所有话题主题</div>
        @if(count($datas))
            @foreach($datas as $data)
            <div class="list">
                <div class="theme">
                    <div>话题标题{{ $data->name }}</div>
                    <div>标题内容{{ $data->intro }}</div>
                    <div><a href="/talk/theme{{$data->id}}">进入专题</a></div>
                    <div></div>
                </div>
            </div>
            @endforeach
        @else <div class="title">暂无主题</div>
        @endif
    </div>
@stop