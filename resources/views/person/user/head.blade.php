@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')

        <div class="per_list">
            <p class="title">个人头像</p>
            <div class="list">
                原来头像：
                @if($data->head)
                <img src="{{ $data->head() }}">
                @else
                    <div style="margin:0;width:300px;height:300px;background:rgb(240,240,240);border:0;"></div>
                @endif
                <br>
                选择头像：
            </div>
        </div>

        @include('person.user.right')
    </div>
@stop