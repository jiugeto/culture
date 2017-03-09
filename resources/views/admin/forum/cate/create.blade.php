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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/theme" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>专题名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" name="name" required/>
                        </div>

                        <div class="am-form-group">
                            <label>用户 / User：</label>
                            <input type="text" placeholder="不填代表本站" name="uname"/>
                        </div>

                        <div class="am-form-group">
                            <label>专题内容 / Introduce：</label>
                            <textarea cols="50" rows="5" placeholder="内容必填" minlength="2" required name="intro"></textarea>
                            {{--@include('UEditor::head')--}}
                            {{--这里可以排版文字，插入或粘贴图片--}}
                            {{--<script type="text/plain" id="container" name="intro"></script>--}}
                            {{--<script type="text/javascript">--}}
                                {{--var ue = UE.getEditor('container',{--}}
                                    {{--initialFrameWidth:650,--}}
                                    {{--initialFrameHeight:300,--}}
                                    {{--toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','indent','priview','directionality','paragraph','searchreplace','insertimage','imagefloat','pasteplain','help','fullscreen']]--}}
                                {{--});--}}
                                {{--ue.ready(function() {--}}
                                    {{--//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.--}}
                                    {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');--}}
                                {{--});--}}
                            {{--</script>--}}
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label>排序 / Sort：</label>--}}
                            {{--<input type="text" placeholder="" pattern="^\d+$" name="sort" required value="10"/>--}}
                        {{--</div>--}}

                        {{--<div class="am-form-group">--}}
                            {{--<label>前台是否显示 / Is Show：</label>--}}
                            {{--<label><input type="radio" name="isshow" value="0"> 前台列表不显示&nbsp;&nbsp;</label>--}}
                            {{--<label><input type="radio" name="isshow" value="1" checked> 前台列表显示&nbsp;&nbsp;</label>--}}
                        {{--</div>--}}

                        <button type="submit" class="am-btn am-btn-primary" onclick="history.go(-1)">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

