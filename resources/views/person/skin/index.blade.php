@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">皮肤设置</p>
            <div class="list">
                <p class="user_info">顶部设置</p>
                <div class="top_bg"><img src="{{ $data->getTopBg() }}"></div>
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop