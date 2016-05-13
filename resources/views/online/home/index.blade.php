@extends('online.main')
@section('content')
    {{--内页的样式方便调节动画--}}
    {{--<link rel="stylesheet" href="/assets-home/css/online.css">--}}
    <style>
        @if(count($attrs))
        @foreach($attrs as $attr)
        /*第一级属性样式：.attr*/
        {{'.'.$attr->style_name}} {
        {{-- margin --}} @if($attr->margin!='')margin:{{$attr->margin1==''?'auto':$attr->margin1.'px'}} {{$attr->margin2==''?'auto':$attr->margin1.'px'}}{{isset($attr->margin3)?' '.$attr->margin3.'px':''}}{{isset($attr->margin4)?' '.$attr->margin4.'px':''}};@endif{{-- padding --}} @if($attr->padding!='')padding:{{$attr->padding1==''?'auto':$attr->padding1.'px'}} {{$attr->padding2==''?'auto':$attr->padding2.'px'}};@endif{{-- width --}} @if($attr->width!=0){{"width:".$attr->width."px;"}}@endif{{-- height --}} @if($attr->height!=0){{"height:".$attr->height."px;"}}@endif{{-- border --}} @if($attr->border)border{{in_array($attr->border1,[1,2,3,4])?"-".$attr->borderDirection($attr->border1):''}}:{{$attr->border2."px"}} {{$attr->border3?$attr->borderType($attr->border3):''}} {{$attr->border4}};@endif{{-- 颜色 --}} @if($attr->color)color:{{$attr->color}};@endif{{-- 文字尺寸 --}} @if($attr->font_size!=0)font-size:{{$attr->font_size}}px;@endif{{-- 字间距 --}} @if($attr->word_spacing!=0)word-spacing:{{$attr->word_spacing}}px;@endif{{-- 行高 --}} @if($attr->line_height!=0)line-height:{{$attr->line_height}}px;@endif{{-- 字体变换 --}} @if($attr->text_transform)text-transform:{{$attr->textTransform()}};@endif{{-- 水平对齐 --}} @if($attr->text_align)text-align:{{$attr->textAlign()}};@endif{{-- 背景 --}} @if($attr->background)background:{{$attr->background}};@endif{{-- 定位 --}} @if($attr->position)position:{{$attr->positionType()}};@endif{{-- 左边距离 --}} @if($attr->position)left:{{$attr->left}}px;@endif{{-- 顶部边距离 --}} @if($attr->position)top:{{$attr->top}}px;@endif{{-- 透明度 --}} @if($attr->opacity!='')opacity:{{$attr->opacity}};@endif
        }
        /*第二级属性样式：.attr div.pos*/
        @if(isset($attr->child[0]) && $attr2=$attr->child[0])
        {{'.'.$attr->style_name.' .pos'}} {
        {{-- margin --}} @if($attr2->margin!='')margin:{{$attr2->margin1==''?'auto':$attr2->margin1.'px'}} {{$attr2->margin2==''?'auto':$attr2->margin1.'px'}}{{isset($attr2->margin3)?' '.$attr2->margin3.'px':''}}{{isset($attr2->margin4)?' '.$attr2->margin4.'px':''}};@endif{{-- padding --}} @if($attr2->padding!='')padding:{{$attr2->padding1==''?'auto':$attr2->padding1.'px'}} {{$attr2->padding2==''?'auto':$attr2->padding2.'px'}};@endif{{-- width --}} @if($attr2->width!=0){{"width:".$attr2->width."px;"}}@endif{{-- height --}} @if($attr2->height!=0){{"height:".$attr2->height."px;"}}@endif{{-- border --}} @if($attr2->border)border{{in_array($attr2->border1,[1,2,3,4])?"-".$attr2->borderDirection($attr2->border1):''}}:{{$attr2->border2."px"}} {{$attr2->border3?$attr2->borderType($attr2->border3):''}} {{$attr2->border4}};@endif{{-- 颜色 --}} @if($attr2->color)color:{{$attr2->color}};@endif{{-- 文字尺寸 --}} @if($attr2->font_size!=0)font-size:{{$attr2->font_size}}px;@endif{{-- 字间距 --}} @if($attr2->word_spacing!=0)word-spacing:{{$attr2->word_spacing}}px;@endif{{-- 行高 --}} @if($attr2->line_height!=0)line-height:{{$attr2->line_height}}px;@endif{{-- 字体变换 --}} @if($attr2->text_transform)text-transform:{{$attr2->textTransform()}};@endif{{-- 水平对齐 --}} @if($attr2->text_align)text-align:{{$attr2->textAlign()}};@endif{{-- 背景 --}} @if($attr2->background)background:{{$attr2->background}};@endif{{-- 定位 --}} @if($attr2->position)position:{{$attr2->positionType()}};@endif{{-- 左边距离 --}} @if($attr2->position)left:{{$attr2->left}}px;@endif{{-- 顶部距离 --}} @if($attr2->position)top:{{$attr2->top}}px;@endif{{-- 透明度 --}} @if($attr2->opacity!='')opacity:{{$attr2->opacity}};@endif
        }
        /*第三级属性样式：.attr div.dh*/
        @if(isset($attr2->child[0]) && $attr3=$attr2->child[0])
        {{'.'.$attr->style_name.' .dh'}} {
        {{-- margin --}} @if($attr3->margin!='')margin:{{$attr3->margin1==''?'auto':$attr3->margin1.'px'}} {{$attr3->margin2==''?'auto':$attr3->margin1.'px'}}{{isset($attr3->margin3)?' '.$attr3->margin3.'px':''}}{{isset($attr3->margin4)?' '.$attr3->margin4.'px':''}};@endif{{-- padding --}} @if($attr3->padding!='')padding:{{$attr3->padding1==''?'auto':$attr3->padding1.'px'}} {{$attr3->padding2==''?'auto':$attr3->padding2.'px'}};@endif{{-- width --}} @if($attr3->width!=0){{"width:".$attr3->width."px;"}}@endif{{-- height --}} @if($attr3->height!=0){{"height:".$attr3->height."px;"}}@endif{{-- border --}} @if($attr3->border)border{{in_array($attr3->border1,[1,2,3,4])?"-".$attr3->borderDirection($attr3->border1):''}}:{{$attr3->border2."px"}} {{$attr3->border3?$attr3->borderType($attr3->border3):''}} {{$attr3->border4}};@endif{{-- 颜色 --}} @if($attr3->color)color:{{$attr3->color}};@endif{{-- 文字尺寸 --}} @if($attr3->font_size!=0)font-size:{{$attr3->font_size}}px;@endif{{-- 字间距 --}} @if($attr3->word_spacing!=0)word-spacing:{{$attr3->word_spacing}}px;@endif{{-- 行高 --}} @if($attr3->line_height!=0)line-height:{{$attr3->line_height}}px;@endif{{-- 字体变换 --}} @if($attr3->text_transform)text-transform:{{$attr3->textTransform()}};@endif{{-- 水平对齐 --}} @if($attr3->text_align)text-align:{{$attr3->textAlign()}};@endif{{-- 背景 --}} @if($attr3->background)background:{{$attr3->background}};@endif{{-- 定位 --}} @if($attr3->position)position:{{$attr3->positionType()}};@endif{{-- 左边距离 --}} @if($attr3->position)left:{{$attr3->left}}px;@endif{{-- 顶部距离 --}} @if($attr3->position)top:{{$attr3->top}}px;@endif{{-- 透明度 --}} @if($attr3->opacity!='')opacity:{{$attr3->opacity}};@endif
            }
        /*第四级属性样式：.attr img*/
        @if(isset($attr3->child[0]) && $attr4=$attr3->child[0])
        {{'.'.$attr->style_name.' img'}} {
        {{-- margin --}} @if($attr4->margin!='')margin:{{$attr4->margin1==''?'auto':$attr4->margin1.'px'}} {{$attr4->margin2==''?'auto':$attr4->margin1.'px'}}{{isset($attr4->margin3)?' '.$attr4->margin3.'px':''}}{{isset($attr4->margin4)?' '.$attr4->margin4.'px':''}};@endif{{-- padding --}} @if($attr4->padding!='')padding:{{$attr4->padding1==''?'auto':$attr4->padding1.'px'}} {{$attr4->padding2==''?'auto':$attr4->padding2.'px'}};@endif{{-- width --}} @if($attr4->width!=0){{"width:".$attr4->width."px;"}}@endif{{-- height --}} @if($attr4->height!=0){{"height:".$attr4->height."px;"}}@endif{{-- border --}} @if($attr4->border)border{{in_array($attr4->border1,[1,2,3,4])?"-".$attr4->borderDirection($attr4->border1):''}}:{{$attr4->border2."px"}} {{$attr4->border3?$attr4->borderType($attr4->border3):''}} {{$attr4->border4}};@endif{{-- 颜色 --}} @if($attr4->color)color:{{$attr4->color}};@endif{{-- 文字尺寸 --}} @if($attr4->font_size!=0)font-size:{{$attr4->font_size}}px;@endif{{-- 字间距 --}} @if($attr4->word_spacing!=0)word-spacing:{{$attr4->word_spacing}}px;@endif{{-- 行高 --}} @if($attr4->line_height!=0)line-height:{{$attr4->line_height}}px;@endif{{-- 字体变换 --}} @if($attr4->text_transform)text-transform:{{$attr4->textTransform()}};@endif{{-- 水平对齐 --}} @if($attr4->text_align)text-align:{{$attr4->textAlign()}};@endif{{-- 背景 --}} @if($attr4->background)background:{{$attr4->background}};@endif{{-- 定位 --}} @if($attr4->position)position:{{$attr4->positionType()}};@endif{{-- 左边距离 --}} @if($attr4->position)left:{{$attr4->left}}px;@endif{{-- 顶部距离 --}} @if($attr4->position)top:{{$attr4->top}}px;@endif{{-- 透明度 --}} @if($attr4->opacity!='')opacity:{{$attr4->opacity}};@endif
            }
        @endif
        @endif
        @endif
        @endforeach
        @endif
        /*================================*/
        .timeline { margin-bottom:5px; width:980px; height:5px; overflow:hidden; }
        .timeline div.dh { width:980px; height:2px; background:red; }

        {{--动画样式--}}
        /*动画的代码开始：定义动画时间*/
        @if(count($layers))
        @foreach($layers as $layer)
        {{'.'.$layer->attrname().' .dh'}} {
            animation-name:{{$layer->animation_name}};
            animation-duration:{{$layer->duration}}s;
            animation-timing-function:{{$layer->func()}};
            animation-delay:{{$layer->delay}}s;
            animation-iteration-count:{{$layer->count}};
            animation-direction:{{$layer->direction()}};
            {{--animation-play-state:{{$layer->state()}};--}}
            /*animation-play-state:paused;*/
            animation-play-state:{{$restart?'running':'paused'}};
            animation-fill-mode:{{$layer->mode()}};
        }
        @endforeach
        @endif
        /*时间线进度条*/
        .timeline div.dh {
            position:relative; left:-980px;
            animation-name:timeline;
            /*animation-play-state:paused;*/
            animation-play-state:{{$restart?'running':'paused'}};
            animation-duration:{{$layers[count($layers)-1]->duration+$layers[count($layers)-1]->delay}}s;
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
            @foreach($layer->pers() as $kper=>$per){{$per."% { "}} @foreach($layer->fields() as $kfield2=>$field2){{$field2}}:{{$layer->values()[$kfield2][$kper]}}{{in_array($field2,['width','height','left','top','line_height',''])?'px':''}}; @endforeach{{" }"}}
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
            {{--动画开始--}}
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
            {{--动画结束--}}
        </div>
    </div>
    <div class="switch">
        <div class="timeline"><div class="dh" id="timeline">{{--时间线进度条--}}</div></div>
        <a id="play" title="暂停后播放"><button class="onlinebtn">播放</button></a>
        <a id="stop"><button class="onlinebtn">暂停</button></a>
        <a href="/online" title="退回到原始状态"><button class="onlinebtn">重置</button></a>
        <a href="/online/restart" title="直接播放"><button class="onlinebtn">重播</button></a>
        <a id="menu"><button class="onlinebtn">菜单</button></a>
    </div>
    <div class="menus"></div>

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