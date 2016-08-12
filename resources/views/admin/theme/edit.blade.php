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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/theme/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>专题名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" name="name" required value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>用户名称 / User Name：</label>
                            <input type="text" placeholder="{{ $data->getUserName() }}" name="username" value="{{ $data->username }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>专题内容 / Introduce：</label>
                            @include('UEditor::head')
                            {{--这里可以排版文字，插入或粘贴图片--}}
                            <script type="text/plain" id="container" name="intro">
                                {!! $data->intro !!}
                            </script>
                            <script type="text/javascript">
                                var ue = UE.getEditor('container',{
                                    initialFrameWidth:650,
                                    initialFrameHeight:300,
                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','indent','priview','directionality','paragraph','searchreplace','insertimage','imagefloat','pasteplain','help','fullscreen']]
                                });
                                ue.ready(function() {
                                    //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                                });
                            </script>
                        </div>

                        <div class="am-form-group">
                            <label>排序 / Sort：</label>
                            <input type="text" placeholder="" pattern="^\d+$" name="sort" required value="{{ $data->sort }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0"
                                        {{ $data->isshow==0 ? 'checked' : '' }}> 前台列表不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1"
                                        {{ $data->isshow==1 ? 'checked' : '' }}> 前台列表显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

