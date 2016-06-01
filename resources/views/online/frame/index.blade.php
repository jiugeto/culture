@extends('online.main')
@section('content')
    @include('online.common.style')
    @include('online.common.show')
    <div class="online_frame" style="@if(isset($footSwitch)&&!$footSwitch)bottom:25px;@endif">
        {{--属性修改--}}
        <div class="frame">
            <div class="menus">
                {{--<div class="grey">样式修改 {{ count($attrs) }}</div>--}}
                {{--<div class="oneframe">--}}
            {{--@if(count($attrs))--}}
                {{--@foreach($attrs as $attr)--}}
                    {{--{{ $attr->name }}--}}
                    {{--@if($attr->attrs())--}}
                        {{--@foreach($attr->attrs() as $attr1)--}}
                        {{--<div>属性名：属性值</div>--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--@endif--}}
                {{--</div>--}}
            </div>
        </div>
        {{--动画内容修改--}}
        <div class="frame">
            <div class="menus">
                <div class="grey"><a>动画内容修改</a></div>
            </div>
        </div>
        {{--动画帧修改--}}
        <div class="frame">
            <div class="menus">
                <div class="grey"><a>动画单帧修改 {{ count($layers) }}</a></div>
                {{--@if(count($layers))--}}
                    {{--@foreach($layers as $layer)--}}
                    {{--<div class="oneframe">--}}
                    {{--</div>--}}
                    {{--@endforeach--}}
                {{--@endif--}}
            </div>
        </div>
        <div style="height:200px;">{{--空白--}}</div>
    </div>
@stop