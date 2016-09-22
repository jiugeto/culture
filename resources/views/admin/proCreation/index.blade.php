@extends('admin.main')
@section('content')
    @include('admin.proCreation.style')

    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>
        <hr>

        <div class="am-g out">
            <div class="title">{{$product->name}}</div>
            <iframe src="{{DOMAIN}}admin/{{$product->id}}/pro/play" frameborder="0" width="720" height="438" scrolling="no" allowtransparency="true"></iframe>
            @if($curr_url!='edit')
            <a href="{{DOMAIN}}admin/{{$product->id}}/pro/edit"><div id="edit">编 辑</div></a>
            @else
            <a href="{{DOMAIN}}admin/{{$product->id}}/pro"><div id="edit">预览</div></a>
            @endif
        </div>
    </div>
@stop