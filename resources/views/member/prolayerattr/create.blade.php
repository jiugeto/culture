@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <form data-am-validator method="POST" action="{{DOMAIN}}member/{{ $layerModel->id }}/prolayerattr" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table class="table_create">
            {{--<tr>--}}
                {{--<td class="field_name"><label>名称：</label></td>--}}
                {{--<td><input type="text" class="field_value" placeholder="至少2个字符" minlength="2" required name="name"/></td>--}}
            {{--</tr>--}}
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>产品名称：</label></td>
                <td>
                    <select name="productid" required>
                    @if(count($model->products()))
                        @foreach($model->products() as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    @endif
                    </select>
                    &nbsp;<a href="{{DOMAIN}}member/product" class="star">产品列表</a>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>属性名称：</label></td>
                <td>
                    <select name="attrid" required>
                    @if(count($model->attrs()))
                        @foreach($model->attrs() as $attr)
                            <option value="{{ $attr->id }}">{{ $attr->name }}</option>
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
                    {{--<select name="layerid" required>--}}
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
                    <select name="attrSel" required>
                        @foreach($model['attrSelNames'] as $kattrSel=>$attrSelName)
                            <option value="{{ $kattrSel }}">{{ $attrSelName }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>动画点：</label></td>
                <td><input type="text" class="field_value" placeholder="动画关键帧，单位%" pattern="^\d+$" required name="per"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr>
                <td class="field_name"><label>动画值：</label></td>
                <td><input type="text" class="field_value" placeholder="动画值" required name="val"/></td>
            </tr>
            {{--<tr><td></td></tr>--}}

            <tr><td colspan="2" style="text-align:center;">
                    <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
                    <button type="submit" class="companybtn">保存添加</button>
                </td></tr>
        </table>
    </form>
@stop

