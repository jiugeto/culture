@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4" style="height:700px">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/ordercre/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>订单名称：{{ $data['pname'] }}</label><br>
                            <label>订单编号：{{ $data['serial'] }}</label>
                        </div>

                        <div class="am-form-group">
                            <label>缩略图 / Thumb：</label><br>
                            {{--@include('admin.common.#piclist')--}}
                            @if($data['thumb'])
                                <img src="{{ $data['thumb'] }}" width="300">
                                <div style="margin:5px 0;border-bottom:1px dashed lightgrey;"></div>
                            @endif
                            @include('admin.common.uploadimg')
                        </div>

                        <br>
                        <div class="am-form-group">
                            <label>视频链接类型 / Link Type：</label><br>
                            @foreach($model['linkTypes'] as $klinkType=>$linkType)
                                <label><input type="radio" required name="linkType" value="{{$klinkType}}"
                                            {{$klinkType==$data['linkType']?'selected':''}}>
                                    {{ $linkType }}&nbsp;&nbsp;</label>
                            @endforeach
                        </div>

                        <div class="am-form-group">
                            <label>视频 / Link：
                                {{--<a href="{{DOMAIN}}admin/video/uploadWay" target="_blank" title="查看视频上传方法">视频上传方法</a>--}}
                            </label>
                            {{--<textarea placeholder="将复制的代码粘贴于此" required name="link" cols="30" rows="5"></textarea>--}}
                            <input type="text" placeholder="" required name="link" value="{{ $data['link'] }}">
                        </div>

                        <button type="button" class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

