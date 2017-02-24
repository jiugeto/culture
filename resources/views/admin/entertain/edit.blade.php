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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/entertain/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>标题 / Title：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="title" value="{{$data['title']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>内容 / Content：</label>
                            <textarea name="intro" cols="50" rows="5" minlength="2" maxlength="255" required>{{$data['intro']}}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>选择艺人 / Actor：</label><br>
                            @if(count($actors))
                                @foreach($actors as $actor)
                                    <label><input type="checkbox" name="actor[]" value="{{$actor['id']}}"
                                          @if(in_array($actor['id'],$data['staffs'])) checked @endif
                                        > {{$actor['name']}}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                @endforeach
                            @endif
                        </div>

                        <div class="am-form-group">
                            <label>选择作品 / Works：</label><br>
                            @if(count($works))
                                @foreach($works as $work)
                                    <label><input type="checkbox" name="work[]" value="{{$work['id']}}"
                                          @if(in_array($work['id'],$data['works'])) checked @endif
                                        > {{$work['name']}}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                @endforeach
                            @endif
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label for="content">内容 / Activity Content：</label>--}}
                            {{--@include('UEditor::head')--}}
                            {{--<script id="container" name="content" type="text/plain">--}}
                                {{--{!! $data->content !!}--}}
                            {{--</script>--}}
                            {{--<!-- 实例化编辑器 -->--}}
                            {{--<script type="text/javascript">--}}
                                {{--var ue = UE.getEditor('container',{--}}
                                    {{--//initialFrameWidth:500,--}}
                                    {{--//initialFrameHeight:200,--}}
{{--//                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','searchreplace','pasteplain','help']]--}}
                                {{--});--}}
                                {{--ue.ready(function() {--}}
                                    {{--//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.--}}
                                    {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');--}}
                                {{--});--}}
                            {{--</script>--}}
                        {{--</div>--}}

                        <div class="am-form-group">
                            <label>用户名称 / User Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="uname" value="{{$data['uname']}}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

