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
                <div style="clear:both;height:10px"></div>
            @endif
        </div>

        {{--创作菜单--}}
        @if($currUrl=='edit')
            @include('admin.proCreation.creation')
        @endif
    </div>
@stop