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
                <form class="am-form" data-am-validator method="POST" action="/admin/comjob" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                    @if($data)
                        <div class="am-form-group">
                            <label>招聘名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}" disabled/>
                            <input type="hidden" name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5" disabled>{{ $data->intro }}</textarea>
                            <input type="hidden" name="intro" value="{{ $data->name }}"/>
                        </div>
                    @else
                        <div class="am-form-group">
                            <label>招聘名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>
                    @endif

                        <div class="am-form-group">
                            <label>工作名称 / Job：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="job"/>
                        </div>

                        <div class="am-form-group">
                            <label>工作数量 / Number：</label>
                            <input type="text" pattern="^\d+$" required name="num"/>
                        </div>

                        <div class="am-form-group">
                            <label>工作要求 / Require：</label>
                            {{--<input type="text" placeholder="至少2个字符" minlength="2" required name="require"/>--}}
                            <textarea name="require" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>排序 / Sort：</label>
                            <input type="text" pattern="^\d+$" required name="sort" value="10"/>
                        </div>

                        <div class="am-form-group">
                            <label>是否置顶 / Is Top：</label>
                            <label><input type="radio" name="istop" value="0" checked> 不置顶&nbsp;&nbsp;</label>
                            <label><input type="radio" name="istop" value="1"> 置顶&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0"> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" checked> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

