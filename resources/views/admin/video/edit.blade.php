@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-form-group">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{DOMAIN}}admin/video">
                                <button type="button" class="am-btn am-btn-default">
                                    <img src="{{PUB}}assets/images/redo.png" class="icon"> 返回视频列表
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/video/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>作品名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>缩略图 / Thumb：</label>
                            @include('admin.common.piclist')
                        </div>

                        <div class="am-form-group">
                            <label>视频信息 / Video：</label>
                            <textarea placeholder="必填信息" required name="link" cols="30" rows="5">{{ $data->url.'?'.$data->url2 }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>简介 / Introduce：</label>
                            <textarea placeholder="选填信息" name="intro" cols="30" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

