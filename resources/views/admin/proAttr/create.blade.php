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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/{{$productid}}/proAttr" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>属性名称 / Name：开始层</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label>层类型 / Genre：</label>--}}
                            {{--<select name="genre" required>--}}
                                {{--@if(count($model['genres']))--}}
                                    {{--@foreach($model['genres'] as $kgenre=>$vgenre)--}}
                                        {{--<option value="{{ $kgenre }}">{{ $vgenre }}</option>--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        @include('admin.proAttr.basicCreate')

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop