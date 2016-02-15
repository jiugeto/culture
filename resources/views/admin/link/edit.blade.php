@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/link/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>链接名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>鼠标移动显示 / Title：</label>
                            <input type="text" name="title" value="{{ $data->title }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>链接类型 / Type：</label>
                            <select name="type" required>
                                @foreach($types as $kt=>$type)
                                    <option value="{{ $kt }}"
                                            {{ $data->type==$kt ? 'selected' : '' }}>
                                        {{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--<div class="am-form-group">
                            <label for="url_ori">链接图片 / Link Pictures：</label>
                        @if($data->pic)
                            <img src="{{ $data->pic }}">
                        @else
                            <small class="am-form-help">注意：先添加，再编辑可用图片尺寸。<br>
                                提示：图片尺寸不要大于1M，否则出错。</small>
                            <script src="/assets/js/local_pre.js"></script>
                            <input type="text" placeholder="本地图片地址" readonly name="url_file">
                            <input type="button" value="[找图]" onclick="path.click()" class="am-btn am-btn-primary">
                            <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">
                            <div id="preview" style="margin: 5px; width: 160px; height: 120px; border:1px dotted #5bc0de ; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>
                        @endif
                        </div>--}}

                        <div class="am-form-group">
                            <label>图片id / Picture：
                                (无满意图片？<a href="/admin/pic/create">此处添加</a>)
                            </label>
                            <select name="pic_id">
                                <option value="0"
                                        {{ $data->pic_id==0 ? 'selected' : '' }}>
                                    -请选择-</option>
                                @foreach($pics as $pic)
                                    <option value="{{ $pic->id }}"
                                            {{ $data->pic_id==$pic->id ? 'selected' : '' }}>
                                        {{ $pic->name }}：
                                        <img src="{{ $data->url }}" class="pic_size_small">
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>链接介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>访问链接地址 / Link：</label>
                            <input type="text" placeholder="至少2个字符('/#'代表首页)" minlength="2" required name="link" value="{{ $data->link }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>显示方式 / Way：</label>
                            <label><input type="radio" name="display_way" value="1" {{ $data->display_way==1 ? 'checked' : '' }}>文字方式显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="display_way" value="2" {{ $data->display_way==2 ? 'checked' : '' }}>图片方式显示&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0" {{ $data->isshow==0 ? 'checked' : '' }}>在前台不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" {{ $data->isshow==1 ? 'checked' : '' }}>在前台显示&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>父链接 / Parent：</label>
                            <select name="pid" required>
                                <option value="0" {{ $data->pid==0 ? 'selected' : '' }}>0级链接</option>
                                @foreach($plinks as $plink)
                                    <option value="{{ $plink->id }}" {{ $data->pid==$plink->id ? 'selected' : '' }}>{{ $plink->name }}</option>
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

