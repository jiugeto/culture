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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/product/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="post">
                    <fieldset>
                        <div class="am-form-group">
                            <label>产品名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>产品简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>视频宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="" pattern="^\d{3,4}$" required name="width" value="{{ $data->width }}">
                        </div>

                        <div class="am-form-group">
                            <label>视频高度 / Height：(单位px)</label>
                            <input type="text" placeholder="" pattern="^\d{3,4}$" required name="height" value="{{ $data->height }}">
                        </div>

                        <div class="am-form-group">
                            <label>是否置顶 / Is Top：</label>
                            <label><input type="radio" name="istop" value="0" {{ $data->istop==0 ? 'checked' : ''}}> 不置顶&nbsp;&nbsp;</label>
                            <label><input type="radio" name="istop" value="1" {{ $data->istop==1 ? 'checked' : ''}}> 置顶&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>排序 / sort：</label>
                            <input type="text" placeholder="" pattern="^\d+$" required name="sort" value="{{ $data->sort }}">
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0" {{ $data->isshow==0 ? 'checked' : ''}}> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" {{ $data->isshow==1 ? 'checked' : ''}}> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

