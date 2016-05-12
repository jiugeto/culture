@extends('online.main')
@section('content')
    {{--内页的样式方便调节动画--}}
    <style>
        @if(count($attrs))
        @foreach($attrs as $attr)
        {{'.'.$attr->style_name.' .hd'}} {
            {{-- margin --}} @if($attr->margin!='')margin:{{$attr->margin1==''?'auto':$attr->margin1.'px'}} {{$attr->margin2==''?'auto':$attr->margin1.'px'}};@endif{{-- padding --}} @if($attr->padding!='')padding:{{$attr->padding1==''?'auto':$attr->padding1.'px'}} {{$attr->padding2==''?'auto':$attr->padding2.'px'}};@endif{{-- width --}} @if($attr->width!=0){{"width:".$data->width."px;"}}@endif{{-- height --}} @if($attr->height!=0){{"height:".$data->height."px;"}}@endif{{-- border --}} @if($attr->border)border{{in_array($data->border1,[1,2,3,4])?"-".$attr->borderDirection($attr->border1):''}}:{{$attr->border2."px"}} {{$attr->border3?$attr->borderType($attr->border3):''}} {{$attr->border4}};@endif{{-- 颜色 --}} @if($attr->color)color:{{$attr->color}};@endif{{-- 文字尺寸 --}} @if($attr->font_size!=0)font-size:{{$attr->font_size}}px;@endif{{-- 字间距 --}} @if($attr->word_spacing!=0)word-spacing:{{$attr->word_spacing}}px;@endif{{-- 行高 --}} @if($attr->line_height!=0)line-height:{{$attr->line_height}}px;@endif{{-- 字体变换 --}} @if($attr->text_transform)text-transform:{{$attr->textTransform()}};@endif{{-- 水平对齐 --}} @if($attr->text_align)text-align:{{$attr->textAlign()}};@endif{{-- 背景 --}} @if($attr->background)background:{{$attr->background}};@endif{{-- 定位 --}} @if($attr->position)position:{{$attr->positionType()}};@endif{{-- 左边距离 --}} @if($attr->position)left:{{$attr->left}}px;@endif{{-- 顶部距离 --}} @if($attr->position)top:{{$attr->top}}px;@endif
        }
        {{'.'.$attr->style_name}} img { height:540px; }
        @endforeach
        @endif
        /*================================*/
        .timeline { margin-bottom:5px; width:980px; height:5px; overflow:hidden; }
        .timeline div.dh { width:980px; height:2px; background:red; }

        {{--动画样式--}}
        /*动画的代码开始：定义动画时间*/
        @if(count($layers))
            @foreach($layers as $layer)
            .attr_attr1 .dh {
                @if($layer->field)
                @foreach($layer->fields() as $kfield=>$field) {{$field}}:{{$layer->values()[$kfield][0]}}px; @endforeach
                @endif
                animation-name:{{$layer->animation_name}};
                animation-play-state:paused;
                animation-duration:1.5s;
                animation-timing-function:ease;
                animation-delay:0s;
                animation-fill-mode:forwards;
            }
            @endforeach
        @endif
        /*时间线进度条*/
        .timeline div.dh {
            position:relative; left:-980px;
            animation-name:timeline;
            animation-play-state:paused;
            animation-duration:19s;
            animation-timing-function:linear;
            animation-delay:0s;
            animation-fill-mode:forwards;
        }

        /*动画的代码开始*/
        @if(count($layers))
        @foreach($layers as $layer)
        {{"@keyframes ".$layer->animation_name}}
        {
            @if($layer->per)
            @foreach($layer->pers() as $kper=>$per))
                {{$per."% { "}}
                @foreach($layer->fields() as $kfield2=>$field2)
                {{$field2}}:{{$layer->values()[$kfield2][$kper]}}{{in_array($field2,['width','height','left','top','line_height',''])?'px':''}};
                @endforeach
                {{" }"}}
            @endforeach
            @endif
        }
        @endforeach
        @endif

        /*时间线进度条*/
        @keyframes timeline
        {
            from { left:-980px; }
            to { left:0px; }
        }
    </style>

    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="animate" style="background:white;">
            @if(count($attrs))
                @foreach($attrs as $attr)
            <div class="{{ $attr->style_name }}">
                {{--动画开始--}}
                <div class="pos">
                    <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="switch">
        <div class="timeline"><div class="dh" id="timeline">{{--时间线进度条--}}</div></div>
        <a id="play"><button class="onlinebtn">播放</button></a>
        <a id="stop"><button class="onlinebtn">暂停</button></a>
    </div>

    <script>
        $(document).ready(function(){
            var dh = $(".dh");
            $("#play").click(function(){
                dh.css('animation-play-state','running');
            });
            $("#stop").click(function(){
                dh.css('animation-play-state','paused');
            });
        });
    </script>
@stop