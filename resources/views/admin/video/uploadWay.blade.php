{{--关于视频上传到乐视云点播方式说明--}}


@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                @include('layout.videoUploadWay')
            </div>
        </div>
    </div>
@stop