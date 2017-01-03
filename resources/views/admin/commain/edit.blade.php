@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/commain/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>公司名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>鼠标移动显示 / Title：</label>
                            <input type="text" name="title" value="{{ $data->title }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>网站关键字 / Keyword：</label>
                            <input type="text" name="keyword" value="{{ $data->keyword }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>网站描述 / Description：</label>
                            <input type="text" name="description" value="{{ $data->description }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>logo / Logo：</label>
                            @if($data->logo)
                                <br>
                                <img src="{{ $data->logo }}" width="300">
                                <div style="margin:5px 0;border-bottom:1px dashed lightgrey;"></div>
                            @endif
                            <label>重新上传：</label><br>
                            @include('admin.common.uploadimg')
                        </div>

                        <div class="am-form-group">
                            <label>排序 / Sort：</label>
                            <input type="text" name="sort" placeholder="排序。默认10" value="{{ $data->sort }}">
                        </div>

                        <div class="am-form-group">
                            <label>是否置顶 / Is Top：</label>
                            <label><input type="radio" name="istop" value="0" {{ $data->istop==0 ? 'checked' : '' }}> 不置顶&nbsp;&nbsp;</label>
                            <label><input type="radio" name="istop" value="1" {{ $data->istop==1 ? 'checked' : '' }}> 置顶&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0" {{ $data->isshow==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" {{ $data->isshow==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

