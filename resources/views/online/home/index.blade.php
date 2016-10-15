@extends('online.main')
@section('content')
    <div class="online_list" style="height:900px;background:rgb(40,40,40);">
        <div class="condition">
            <div class="attr" style="text-align:right">
                <a href="{{DOMAIN}}online" style="color:{{isset(explode('/',$_SERVER['REQUEST_URI'])[2])?'grey':'orangered'}};">
                    <b>作品大厅</b>
                </a>
                @if(Session::has('user'))
                    <a href="{{DOMAIN}}online/u/product"
                       style="color:{{isset(explode('/',$_SERVER['REQUEST_URI'])[2])?'orangered':'grey'}};">
                        <b>我的作品列表</b>
                    </a>
                    <a href="{{DOMAIN}}online/u/order"><b>渲染列表</b></a>
                    {{--<a href="{{DOMAIN}}online/u/order/finish"><b>我的成品</b></a>--}}
                @endif
            </div>
            <div class="attr">
                类型：
                <a href="
                    @if($_SERVER['REQUEST_URI']=='/online/u/product')
                    {{DOMAIN}}online/u/product
                    @else
                    {{DOMAIN}}online
                    @endif
                    " class="{{$cate==0?'curr':''}}">全部</a>
                @foreach($model['cates2'] as $kcate=>$vcate)
                    <a href="
                        @if($_SERVER['REQUEST_URI']=='/online/u/product')
                        {{DOMAIN}}online/u/product/c/{{$kcate}}
                        @else
                        {{DOMAIN}}online/c/{{$kcate}}
                        @endif
                            " class="{{$cate==$kcate?'curr':''}}">{{ $vcate }}</a>
                @endforeach
            </div>
        </div>

        <div class="list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="
                @if($_SERVER['REQUEST_URI']=='/online/u/product')
                {{DOMAIN}}online/u/product/{{$data->id}}
                @else
                {{DOMAIN}}online/pre/{{$data->id}}
                @endif
                    " target="_blank" title="点击预览">
                <div class="prolist">
                    <div class="pro_one">
                        <img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getUserPicSize($data->pic($data->gif),$w=200,$h=150))width:{{$size['w']}}px;height:{{$size['h']}}px; @endif">
                    </div>
                    <div class="pname"><b>{{ $data->name }}</b>
                        <div class="small">{{ date("Y年m月",$data->created_at) }}</div>
                    </div>
                </div>
            </a>
                @endforeach
            @endif
            {{--@if(count($datas))--}}
                @for($i=0;$i<$datas->limit-count($datas);++$i)
            <a href="" title="点击预览">
                <div class="prolist">
                    <div class="pro_one">+</div>
                    <div class="pname"><b>产品名称</b>
                        <div class="small">时间</div>
                    </div>
                </div>
            </a>
                @endfor
            {{--@endif--}}

            <div style="clear:both;"></div>
            <div style="margin-top:20px;">@include('person.common.page')</div>
        </div>
    </div>
@stop