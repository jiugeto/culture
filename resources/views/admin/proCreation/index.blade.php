@extends('admin.main')
@section('content')

    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/product">
                            <button type="button" class="am-btn am-btn-default">返回产品列表</button>
                        </a>
                        @if($currUrl=='edit')
                        <a href="{{DOMAIN}}admin/{{$product->id}}/creation">
                            <button type="button" class="am-btn am-btn-default">返回预览</button>
                        </a>
                        @else
                        <a href="{{DOMAIN}}admin/{{$product->id}}/creation/edit">
                            <button type="button" class="am-btn am-btn-default">编辑</button>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr>

        {{--展示窗口--}}
        <div class="am-g admin_out">
            <div class="title">{{$product->name}}</div>
            <iframe src="{{DOMAIN}}admin/{{$product->id}}/pro/{{$currUrl=='edit'?'edit':'play'}}/{{$layerid}}/{{$con_id}}/{{$attrGenre}}" frameborder="0" width="720" height="{{$currUrl=='edit'?405:438}}" scrolling="no" allowtransparency="true"></iframe>

            @if($currUrl=='edit')
                <a href="{{DOMAIN}}admin/{{$product->id}}/creation"><div id="edit">预览</div></a>
            @else
                <a href="{{DOMAIN}}admin/{{$product->id}}/creation/edit"><div id="edit">编 辑</div></a>
            @endif

            {{--时间栏--}}
            @if($currUrl=='edit')
                @include('admin.proCreation.layer')
                {{--<div class="timetab">--}}
                    {{--<p class="tabt" style="">时间栏</p>--}}
                    {{--<div class="title">--}}
                        {{--@if(count($layers))--}}
                            {{--@foreach($layers as $layer)--}}
                        {{--<div class="tab" @if($layer->id==$layerid)style="color:orangered;"@endif>--}}
                            {{--{{str_limit($layer->name,6)}}({{$layer->delay}}-{{$layer->delay+$layer->timelong}}s)--}}
                        {{--</div>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="layerlist">--}}
                        {{--@if(count($layers))--}}
                            {{--@foreach($layers as $layer)--}}
                        {{--<div class="layer set">--}}
                            {{--<form method="POST" id="formLayer" action="" enctype="multipart/form-data">--}}
                                {{--<p>延迟：<input type="text" name="delay" value="{{ $layer->delay }}"> s</p>--}}
                                {{--<p>时长：<input type="text" name="timelong" value="{{ $layer->timelong }}"> s</p>--}}
                                {{--<p>--}}
                                    {{--曲线：<select name="func">--}}
                                        {{--@foreach($layerModel['funcNames'] as $kfunc=>$funcName)--}}
                                            {{--<option value="{{ $kfunc }}" {{ $layer->func==$kfunc?'selected':'' }}>{{ $funcName }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</p>--}}
                                {{--<button type="submit" class="am-btn am-btn-primary submit">保存修改</button>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                        {{--<div class="layer attr">--}}
                            {{--@if(count($layer->getLayerAttrs()) && $layerAttrs=$layer->getLayerAttrs())--}}
                            {{--<form method="POST" id="formlayerAttr" action="" enctype="multipart/form-data">--}}
                                {{--定位：--}}
                                {{--<label><input type="radio" class="radio" name="isLayerPos" value="0" checked> 无&nbsp;</label>--}}
                                {{--<label><input type="radio" class="radio" name="isLayerPos" value="1"> 有&nbsp;</label>--}}
                                {{--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;透明度：--}}
                                {{--<label><input type="radio" class="radio" name="isLayerOpacity" value="0" checked> 无&nbsp;</label>--}}
                                {{--<label><input type="radio" class="radio" name="isLayerOpacity" value="1"> 有&nbsp;</label>--}}
                                {{--<table style="margin-top:5px">--}}
                                    {{--<tr>--}}
                                        {{--<td>百分比</td>--}}
                                        {{--<td>宽</td>--}}
                                        {{--<td>高</td>--}}
                                        {{--<td>左边距</td>--}}
                                        {{--<td>右边距</td>--}}
                                        {{--<td>透明度</td>--}}
                                    {{--</tr>--}}
                                {{--</table>--}}
                            {{--</form>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="addTimeTab" onclick="">+</div>--}}
                <div style="clear:both;height:10px"></div>
            @endif
        </div>

        {{--创作菜单--}}
        @if($currUrl=='edit')
            @include('admin.proCreation.creation')
        @endif
    </div>
@stop