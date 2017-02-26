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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/storyboard/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>分镜名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name" value="{{$data['name']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>供求类型 / Genre：</label><br>
                            @foreach($model['genres'] as $k=>$vgenre)
                            <label><input type="radio" class="radio" name="genre" value="{{$k}}"
                                        {{$k==$data['genre']?'checked':''}}/> {{$vgenre}}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            @endforeach
                        </div>

                        <div class="am-form-group">
                            <label>分镜类型 / Category：</label><br>
                            @foreach($model['cates'] as $k=>$vcate)
                            <label><input type="radio" class="radio" name="cate" value="{{$k}}"
                                        {{$k==$data['cate']?'checked':''}}/> {{$vcate}}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            @endforeach
                        </div>

                        <div class="am-form-group">
                            <label>简介 / Intro：</label>
                            <textarea name="intro" placeholder="" cols="40" rows="5" required>{{$data['intro']}}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>详情内容 / Detail：</label>
                            <textarea name="detail" placeholder="" cols="40" rows="5" required>{{$data['intro']}}</textarea>
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label for="content">动态内容 / Activity Content：</label>--}}
                            {{--@include('UEditor::head')--}}
                            {{--<script id="container" name="detail" type="text/plain">--}}
                                {{--{!! $data->detail !!}--}}
                            {{--</script>--}}
                            {{--<!-- 实例化编辑器 -->--}}
                            {{--<script type="text/javascript">--}}
                                {{--var ue = UE.getEditor('container',{--}}
                                    {{--initialFrameWidth:650,--}}
                                    {{--initialFrameHeight:200,--}}
                                    {{--toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','insertImage','searchreplace','pasteplain','help','fullscreen']]--}}
                                {{--});--}}
                                {{--ue.ready(function() {--}}
                                    {{--//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.--}}
                                    {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');--}}
                                {{--});--}}
                            {{--</script>--}}
                        {{--</div>--}}

                        <div class="am-form-group">
                            <label>价格 / Money：</label>
                            <input type="text" placeholder="" pattern="^\d+$" required name="money" value="{{$data['money']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>发布方 / User Name：</label>
                            <input type="text" placeholder="用户昵称" name="uname" value="{{$data['uname']}}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

