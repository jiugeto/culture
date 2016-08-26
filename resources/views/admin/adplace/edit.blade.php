@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/place/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>广告位名称 / Ad Place：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>广告位简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>宽度 / Width：</label>
                            <input type="text" placeholder="输入1-4位数字" pattern="^\d{1,4}$" required name="width" value="{{ $data->width }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>高度 / Height：</label>
                            <input type="text" placeholder="输入1-3位数字" pattern="^\d{1,3}$" required name="height" value="{{ $data->height }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Price：</label>
                            <input type="text" placeholder="输入数字" pattern="^(\d+)|(\d+\.\d{1,2})$" required name="price" value="{{ $data->price }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>广告数量 / Number：</label>
                            <input type="text" placeholder="输入数字" pattern="^\d+$" required name="number" value="{{ $data->number }}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

