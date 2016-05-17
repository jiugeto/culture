@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="/member/{{ $layerModel->id }}/prolayerattr/{{ $data->id }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
        <table class="table_create">
            <tr>
                <td style="text-align:center;" colspan="2"><label>此为{{ $layerModel->name }}的属性动画</label></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>产品名称：</label></td>
                <td>
                    <select name="productid" required>
                    @if(count($model->products()))
                        @foreach($model->products() as $product)
                            <option value="{{ $product->id }}" {{ $data->productid==$product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    @endif
                    </select>
                    &nbsp;<a href="/member/product" class="star">产品列表</a>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>属性名称：</label></td>
                <td>
                    <select name="attrid">
                    @if(count($model->attrs()))
                        @foreach($model->attrs() as $attr)
                            <option value="{{ $attr->id }}" {{ $data->attrid==$attr->id ? 'selected' : '' }}>{{ $attr->name }}</option>
                        @endforeach
                    @endif
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>动画名称：</label></td>
                <td>
                    <input type="text" class="field_name" style="padding:0 5px;background:ghostwhite;" name="layer_name" value="{{ $layerModel->name }}" readonly>
                    {{--<select name="layerid">--}}
                    {{--@if(count($model->layers()))--}}
                        {{--@foreach($model->layers() as $layer)--}}
                            {{--<option value="{{ $layer->id }}">{{ $layer->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                    {{--</select>--}}
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>动画属性：</label></td>
                <td>
                    <select name="attrSel">
                        @foreach($model['attrSelNames'] as $kattrSel=>$attrSelName)
                            <option value="{{ $kattrSel }}" {{ $data->attrSel==$kattrSel ? 'selected' : '' }}>{{ $attrSelName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>动画点：</label></td>
                <td><input type="text" class="field_value" placeholder="动画关键帧，单位%" pattern="^\d+$" required name="per" value="{{ $data->per }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>动画值：</label></td>
                <td><input type="text" class="field_value" placeholder="动画值" required name="val" value="{{ $data->val }}"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

