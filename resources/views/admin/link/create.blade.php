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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/link" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>链接名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>显示方式 / Way：</label>
                            <label><input type="radio" name="display_way" value="1" checked>文字方式显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="display_way" value="2">图片方式显示&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>图片id / Picture：</label>
                            {{--<script src="{{PUB}}assets/js/local_pre.js"></script>--}}
                            {{--<input type="text" placeholder="本地图片地址" readonly name="url_file">--}}
                            {{--<input type="button" value="[找图]" onclick="path.click()" class="am-btn am-btn-primary">--}}
                            {{--<input type="file" id="path" style="display:none"--}}
                                   {{--onchange="url_file.value=this.value;loadImageFile();" name="url_ori">--}}
                            {{--<div id="preview" style="margin:5px;width:300px;height:150px;border:1px dotted #5bc0de;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>--}}
                            先添加，在上传图片。
                        </div>

                        <div class="am-form-group">
                            <label>鼠标移动显示 / Title：</label>
                            <input type="text" name="title"/>
                        </div>

                        <div class="am-form-group">
                            <label>链接类型 / Type：</label>
                            <select name="type" onchange="getType(this.value)">
                                @foreach($model['types'] as $k=>$vtype)
                                    <option value="{{$k}}">{{$vtype}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>父链接 / Parent：</label>
                            <select name="pid" required>
                                <option value="0">0级链接</option>
                                @foreach($plinks as $plink)
                                    @if($plink['type']==1)
                                    <option value="{{$plink['id']}}">{{$plink['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>链接介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>访问链接地址 / Link：</label>
                            <input type="text" placeholder="至少2个字符('/'代表首页)" required name="link"/>
                        </div>

                        <div class="am-form-group">
                            <label>发布公司 / Company Name：</label>
                            <input type="text" placeholder="公司名称，不填代表本站" name="cname"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getType(type){
            var html = '';
            html += '<option value="0">0级链接</option>';
            html += '@foreach($plinks as $plink)';
            if (type==1) {
                html += '@if($plink['type']==1)';
                html += '<option value="{{$plink['id']}}">{{$plink['name']}}</option>';
                html += '@endif';
            } else if (type==2) {
                html += '@if($plink['type']==2)';
                html += '<option value="{{$plink['id']}}">{{$plink['name']}}</option>';
                html += '@endif';
            } else if (type==3) {
                html += '@if($plink['type']==3)';
                html += '<option value="{{$plink['id']}}">{{$plink['name']}}</option>';
                html += '@endif';
            }
            html += '@endforeach';
            html += '';
            $("select[name='pid']").html(html);
        }
    </script>
@stop

