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
                <form class="am-form" data-am-validator method="POST" action="/admin/videocate" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>视频类型名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>类型划分依据 / Type：
                                <a href="/admin/type/create/{{'bs_videos_category'}}">[+添加依据]</a>
                            </label>
                            <select name="type_id">
                                <option value="">-选择-</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>父id / Category：</label>
                            <select name="cate_id">
                                <option value="">-选择-</option>
                                <option value="0">-0级类型-</option>
                                @foreach($pcates as $pcate)
                                    <option value="{{ $pcate->id }}">{{ $pcate->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>类型介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

