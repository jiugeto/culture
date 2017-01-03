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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/goods" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>产品 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>发布者 / User Name：</label><br>
                            <select name="uid" required>
                            @if(count($users))
                                @foreach($users as $user)
                            {{--<label><input type="radio" name="uid" value="{{ $user->id }}"> {{ $user->username }} &nbsp;&nbsp;</label>--}}
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>片源类型 / Genre：</label>
                            <select name="genre">
                                @foreach($model['genres'] as $kgenre=>$vgenre)
                                    <option value="{{ $kgenre }}">{{ $vgenre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>产品主体 / Type：</label>
                            <select name="type">
                                @foreach($model['types'] as $ktype=>$vtype)
                                    <option value="{{ $ktype }}">{{ $vtype }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>分类 / Category：</label>
                            <select name="cate">
                                @foreach($model['cates2'] as $kcate=>$vcate)
                                    <option value="{{ $kcate }}">{{ $vcate }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>缩略图 / Thumb：</label>
                            @include('admin.common.#piclist')
                        </div>

                        <div class="am-form-group">
                            <label>视频信息 / Video：
                                <a href="{{DOMAIN}}admin/video/pre/{{$videos[0]->id}}" target="_blank" id="a_video">当前选择视频预览</a>
                            </label>
                            <select name="video_id">
                                @foreach($videos as $video)
                                    <option value="{{ $video->id }}">{{ $video->name.' -- '.$video->url }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>说明 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>鼠标移动显示文字 / Title：</label>
                            <input type="text" name="title">
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Money：(单位：元)</label>
                            <input type="text" placeholder="供应者预估价格，可以为0" required name="money">
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $("select[name='video_id']").change(function(){
            var video = $(this).val();
            $("#a_video")[0].href = '{{DOMAIN}}admin/video/pre/'+video;
        });
    </script>
@stop

