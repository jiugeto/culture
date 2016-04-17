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
                <form class="am-form" data-am-validator method="POST" action="/admin/link" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>链接名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>鼠标移动显示 / Title：</label>
                            <input type="text" name="title"/>
                        </div>

                        <div class="am-form-group">
                            <label>链接类型 / Type：
                                {{--<a href="/admin/type/create/{{'网站链接-type_id'}}">[+添加类别]</a>--}}
                            </label>
                            <select name="type_id">
                                @foreach($types as $kt=>$type)
                                    <option value="{{ $kt }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>图片id / Picture：
                                {{--(无满意图片？<a href="/admin/pic/create">此处添加</a>)--}}
                            </label>
                            <select name="pic_id">
                                <option value="0">-请选择-</option>
                                @foreach($pics as $pic)
                                    <option value="{{ $pic->id }}">{{ $pic->name }}：<img src="{{ $data->url }}" class="pic_size_small"></option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>链接介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>访问链接地址 / Link：</label>
                            <input type="text" placeholder="至少2个字符('/'代表首页)" minlength="2" required name="link"/>
                        </div>

                        <div class="am-form-group">
                            <label>显示方式 / Way：</label>
                            <label><input type="radio" name="display_way" value="1" checked>文字方式显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="display_way" value="2">图片方式显示&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0">在前台不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" checked>在前台显示&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>父链接 / Parent：</label>
                            <select name="pid" required>
                                <option value="0">0级链接</option>
                                @foreach($plinks as $plink)
                                    <option value="{{ $plink->id }}">{{ $plink->name }}</option>
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

