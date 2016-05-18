@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/{{$layerModel->id}}/prolayerattr" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>产品名称 / Product：
                                <a href="/admin/product">产品列表</a></label>
                            <select name="productid" required>
                                @if($model->productAll())
                                    @foreach($model->productAll() as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>属性统称 / Attr：
                                <a href="/admin/productattr">属性列表</a></label>
                            <select name="attrid" required>
                                @if($model->attrAll())
                                    @foreach($model->attrAll() as $attr)
                                        <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>动画名称 / Layer：</label>
                            <input type="text" name="layer_name" value="{{ $layerModel->name }}" readonly>
                        </div>

                        <div class="am-form-group">
                            <label>动画属性 / Attribute：</label>
                            <select name="attrSel" required>
                                @if($model['attrSels'])
                                    @foreach($model['attrSels'] as $kattrSel=>$attrSel)
                                        <option value="{{ $kattrSel }}">{{ $attrSel }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>动画点 / Per：</label>
                            <input type="text" placeholder="关键帧，0%~100%" pattern="^\d+$" required name="per"/>
                        </div>

                        <div class="am-form-group">
                            <label>动画值 / Val：</label>
                            <input type="text" placeholder="关键值" minlength="1" required name="val"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

