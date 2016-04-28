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
                <form class="am-form" data-am-validator method="POST" action="/admin/comfirm/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>服务名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>内容 / intro：</label>
                            @include('UEditor::head')
                            <script id="container" name="intro" type="text/plain">
                                {!! $data->intro !!}
                            </script>
                            <script type="text/javascript">
                                var ue = UE.getEditor('container',{
                                    //initialFrameWidth:500,
                                    initialFrameHeight:200,
                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','imagefloat','insertimage','searchreplace','pasteplain','help']]
                                });
                                ue.ready(function() {
                                    //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                                });
                            </script>
                        </div>

                        <div class="am-form-group">
                            <label>标题 / Title：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="title" value="{{ $data->title }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>标题说明 / Detail：</label>
                            <textarea name="detail" required cols="40" rows="5">{{ $data->detail }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>图片 / Picture：<a href="/admin/pic">图片列表</a></label>
                            <select name="pic_id">
                                <option value="0"
                                        {{ $data->pic_id==0 ? 'selected' : '' }}>
                                    选择图片</option>
                            @if($pics)
                                @foreach($pics as $pic)
                                <option value="{{ $pic->id }}"
                                        {{ $data->pic_id==$pic->id ? 'selected' : '' }}>
                                    {{ $pic->name }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>标题小字 / Small：</label>
                            <input type="text" placeholder="至少2个字符，多组用|隔开" minlength="2" required name="small" value="{{ $data->small }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>排序 / Sort：</label>
                            <input type="text" pattern="^\d+$" required name="sort" value="{{ $data->sort }}">
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0" {{ $data->isshow==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" {{ $data->isshow==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

