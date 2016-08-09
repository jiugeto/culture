@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <form data-am-validator method="POST" action="/member/{{$lists['func']['url']}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <p style="text-align:center;">{{ $lists['func']['name'] }}添加</p>
        @include('member.goods.create')
    </form>
@stop

