@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/productlayer" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>动画名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>产品名称 / Product：
                                <a href="/admin/product">产品列表</a></label>
                            <select name="productid">
                            @if($model->productAll())
                            @foreach($model->productAll() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                            @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>父id / Parent Id：</label>
                            <select name="pid">
                            @if($model->parents())
                            @foreach($model->parents() as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                            @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>产品简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

