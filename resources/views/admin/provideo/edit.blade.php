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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/provideo/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>需求名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->getUName() }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>定制方式 / Genre：</label>
                            <select name="genre" required>
                                @foreach($model['genres'] as $kgenre=>$genre)
                                    <option value="{{$kgenre}}" {{$kgenre==$data->genre?'selected':''}}>{{$genre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>需求类型 / Category：</label>
                            <select name="cate" required>
                                @foreach($model['cates2'] as $kcate=>$cate)
                                    <option value="{{$kcate}}" {{$kcate==$data->cate?'selected':''}}>{{$cate}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>产品简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>缩略图 / Thumb：</label><br>
                            {{--<input type="text" placeholder="" required name="thumb" value="{{ $data->thumb }}"/>--}}
                            @if(1)
                                <img src="{{ $data->thumb }}" width="300">
                                <div style="margin:10px 0;border-bottom:1px dashed lightgrey;"></div>
                            @endif
                            <label>重新上传：</label><br>
                            @include('admin.common.uploadimg')
                        </div>

                        <div class="am-form-group">
                            <label>参考片网址类型 / Link Type：</label>
                            <br>
                            @foreach($model['linkTypes'] as $klinkType=>$linkType)
                            <label><input type="radio" name="linkType" value="{{$klinkType}}"
                                        {{$klinkType==$data->linkType?'checked':''}}>
                                {{$linkType}} &nbsp;&nbsp;</label>
                            @endforeach
                        </div>

                        <div class="am-form-group">
                            <label>参考片网址链接 / Link：</label>
                            <input type="text" placeholder="" required name="link" value="{{ $data->link }}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

