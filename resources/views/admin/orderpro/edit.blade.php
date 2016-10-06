@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4" style="height:700px">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/orderpro/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>用户名称 / User Name：{{ $data->uname }}</label>
                            <input type="hidden" name="uid" value="{{ $data->uid }}">
                        </div>

                        <div class="am-form-group">
                            <label>缩略图 / Thumb：</label>
                            @include('admin.common.piclist')
                        </div>

                        <div class="am-form-group">
                            <label>视频 / Video：
                                <a href="{{DOMAIN}}admin/video/uploadWay" target="_blank" title="查看视频上传方法">视频上传方法</a>
                            </label>
                            <textarea placeholder="将复制的代码粘贴于此" required name="video" cols="30" rows="5"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

