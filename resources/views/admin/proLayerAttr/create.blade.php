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
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/{{$productid}}/{{$layerid}}/proLayerAttr" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>动画设置名称 / Layer：{{ $layerName }}</label>
                        </div>

                        <div class="am-form-group">
                            <label>动画属性 / Attribute：</label>
                            <select name="attrSel" required>
                                @if($model['attrSelNames'])
                                    @foreach($model['attrSelNames'] as $kattrSel=>$attrSelName)
                                        <option value="{{ $kattrSel }}">{{ $attrSelName }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>动画点 / Per：(单位%)</label>
                            <input type="text" placeholder="关键帧，0%~100%" pattern="^\d+$" required name="per"/>
                        </div>

                        <div class="am-form-group">
                            <label>动画值 / Val：(单位px；透明度0~100无单位)</label>
                            <input type="text" placeholder="关键值" pattern="^\d+$" required name="val"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

