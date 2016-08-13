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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/storyboard/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>分镜名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>供求类型 / Genre：</label><br>
                            @foreach($model['genres'] as $kgenre=>$vgenre)
                            <label><input type="radio" class="radio" name="genre" value="{{ $kgenre }}"
                                        {{ $kgenre==$data->genre ? 'checked' : '' }}/> {{ $vgenre }}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            @endforeach
                        </div>

                        <div class="am-form-group">
                            <label>分镜类型 / Category：</label><br>
                            @foreach($model['cates'] as $kcate=>$vcate)
                            <label><input type="radio" class="radio" name="cate" value="{{ $kcate }}"
                                        {{ $kcate==$data->cate ? 'checked' : '' }}/> {{ $vcate }}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            @endforeach
                        </div>

                        <div class="am-form-group">
                            <label>缩略图 / Thumb：</label>
                            <select name="thumb" required>
                            @if(count($model->getUserPics()))
                            @foreach($model->getUserPics() as $pic)
                                <option value="{{ $pic->id }}" {{ $pic->id==$data->thumb ? 'selected' : '' }}>{{ $pic->name }}</option>
                            @endforeach
                            @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>简介 / Intro：</label>
                            <textarea name="intro" placeholder="" cols="40" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label for="content">动态内容 / Activity Content：</label>
                            @include('UEditor::head')
                            <script id="container" name="detail" type="text/plain">
                                {!! $data->detail !!}
                            </script>
                            <!-- 实例化编辑器 -->
                            <script type="text/javascript">
                                var ue = UE.getEditor('container',{
                                    initialFrameWidth:650,
                                    initialFrameHeight:200,
                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','insertImage','searchreplace','pasteplain','help','fullscreen']]
                                });
                                ue.ready(function() {
                                    //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                                });
                            </script>
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Money：</label>
                            <input type="text" placeholder="" pattern="^[1-9](\d+)?(.\d+)?$" required name="money" value="{{ $data->money }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>用户名称 / User Name：</label>
                            <input type="text" placeholder="用户昵称" name="username" value="{{ $data->username }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>排序 / Sort：</label>
                            <input type="text" placeholder="" pattern="^\d+$" name="sort" value="{{ $data->sort }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>最新 / New：</label>
                            <label><input type="radio" class="radio" name="isnew" value="0" {{ $data->isnew==0 ? 'checked' : '' }}> 非最新&nbsp;&nbsp;</label>
                            <label><input type="radio" class="radio" name="isnew" value="1" {{ $data->isnew==1 ? 'checked' : '' }}> 最新&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>热门 / Hot：</label>
                            <label><input type="radio" class="radio" name="ishot" value="0" {{ $data->ishot==0 ? 'checked' : '' }}> 非最热&nbsp;&nbsp;</label>
                            <label><input type="radio" class="radio" name="ishot" value="1" {{ $data->ishot==1 ? 'checked' : '' }}> 最热&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" class="radio" name="isshow" value="0" {{ $data->isshow==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" class="radio" name="isshow" value="1" {{ $data->isshow==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

