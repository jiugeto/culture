@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/uservoice/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>标题 / Title：</label>
                            <input type="text" placeholder="例：10" pattern="^[1-9]|([1-9]\d+)$" required name="title" value="{{ $data->title }}"/>
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label>标题 / Title：</label>--}}
                            {{--<input type="text" value="{{ $data->uname }}" disabled/>--}}
                        {{--</div>--}}

                        <div class="am-form-group">
                            <label>内容 / Content：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data->content }}</textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

