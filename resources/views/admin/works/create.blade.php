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
                <form class="am-form" data-am-validator method="POST" action="/admin/works" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>作品名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>类型 / Category：</label>
                            <select name="cateid">
                                @foreach($model['cates'] as $kcate=>$cate)
                                    <option value="{{ $kcate }}">{{ $cate }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>视频 / Video：</label>
                            <select name="videoid" required>
                                @foreach($model->videos() as $video)
                                    <option value="{{ $video->id }}">{{ $video->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>剧中演员 / Actor：</label>
                            @if(count($model->actors()))
                            @foreach($model->actors() as $actor)
                                <label><input type="checkbox" name="actor[]" value="{{ $actor->id }}">
                                    {{ $actor->name }}&nbsp;&nbsp;</label>
                            @endforeach
                            @else
                            @endif
                        </div>

                        <div class="am-form-group">
                            <label for="content">动态内容 / Activity Content：</label>
                            @include('UEditor::head')
                            <script id="container" name="intro" type="text/plain"></script>
                            <!-- 实例化编辑器 -->
                            <script type="text/javascript">
                                var ue = UE.getEditor('container',{
                                    //initialFrameWidth:500,
                                    //initialFrameHeight:200,
                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','searchreplace','pasteplain','help']]
                                });
                                ue.ready(function() {
                                    //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                                });
                            </script>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

