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
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="uname"/>
                        </div>

                        <div class="am-form-group">
                            <label>片源类型 / Cate：</label>
                            <select name="cate">
                                @foreach($model['cates'] as $k=>$vcate)
                                    <option value="{{ $k }}">{{ $vcate }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label>缩略图 / Thumb：</label>--}}
                        {{--</div>--}}

                        {{--<div class="am-form-group">--}}
                            {{--<label>视频信息 / Video：</label>--}}
                            {{--<br>类型：--}}
                            {{--<select name="linkType">--}}
                                {{--@foreach($model['linkTypes'] as $k=>$linkType)--}}
                                    {{--<option value="{{$k}}">{{$linkType}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            {{--链接：--}}
                            {{--<input type="text" placeholder="粘贴链接" minlength="2" required name="link"/>--}}
                        {{--</div>--}}

                        <div class="am-form-group">
                            <label>说明 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Money：(单位：元)</label>
                            <input type="text" placeholder="供应者预估价格，可以为0" required name="money" value="0">
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

