@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/video/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>视频名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>视频类型 / Category：
                                <a href="/admin/videocate/create">[+添加类型]</a></label>
                            <select name="cate_id">
                                <option value="0">-选择-</option>
                                @foreach($cates as $cate)
                                    <option value="{{ $cate->id }}"
                                            {{ $data->cate_id==$cate->id ? 'selected' : '' }}>
                                        {{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>视频介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>视频链接 / Link：</label>
                            <input type="text" placeholder="非中文小写字符" pattern="^[a-z_/]$" required name="link" value="{{ $data->link }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>用户名称 / User Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="uname" value="{{ $data->uname }}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

