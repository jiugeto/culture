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
                <form class="am-form" data-am-validator method="POST" action="/admin/product" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>产品名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>产品简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>用户名称 / User Name：</label>
                            <input type="text" placeholder="只是2个字符" minlength="2" required name="uname">
                        </div>

                        <div class="am-form-group">
                            <label>css样式 / Css：
                                <a href="">[+添加样式]</a></label>
                            <select name="css_id">
                                <option value="">-选择-</option>
                                @foreach($cssList as $css)
                                    <option value="{{ $css->id }}">{{ $css->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>js动画 / JS：
                                <a href="">[+添加动画]</a></label>
                            <select name="js_id">
                                <option value="">-选择-</option>
                                @foreach($jsList as $js)
                                    <option value="{{ $js->id }}">{{ $js->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

