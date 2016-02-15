@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/pic" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>图片名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>图片类型 / Type：</label>
                            <select name="type_id">
                                <option value="0"
                                        {{ $type_id==0 ? 'selected' : '' }}>
                                    -请选择-</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"
                                            {{ $type_id==$type->id ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label for="url_ori">图片上传 / Upload Pictures：</label>
                            <small class="am-form-help">注意：先添加，再编辑可用图片尺寸。<br>
                                提示：图片尺寸不要大于1M，否则出错。</small>
                            <script src="/assets/js/local_pre.js"></script>
                            <input type="text" placeholder="本地图片地址" readonly name="url_file">
                            <input type="button" value="[找图]" onclick="path.click()" class="am-btn am-btn-primary">
                            <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">
                            <div id="preview" style="margin: 5px; width: 160px; height: 120px; border:1px dotted #5bc0de ; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>
                        </div>

                        <div class="am-form-group">
                            <label>图片介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

