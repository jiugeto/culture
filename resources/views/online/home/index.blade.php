@extends('online.main')
@section('content')
    <div class="online_list" style="height:900px;background:rgb(40,40,40);">
        <div class="condition">
            <div class="attr" style="text-align:right">
                <b>{{ Session::has('user') ? Session::get('user.username').'作品列表' : '作品大厅' }}</b>
            </div>
            <div class="attr">
                样片类型：
                <a href="{{DOMAIN}}online" class="{{$cate==0?'curr':''}}">全部</a>
                @foreach($model['cates2'] as $kcate=>$vcate)
                    <a href="{{DOMAIN}}online/c/{{$kcate}}" class="{{$cate==$kcate?'curr':''}}">{{ $vcate }}</a>
                @endforeach
            </div>
        </div>

        <div class="list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="{{DOMAIN}}online/pre/{{$data->id}}" target="_blank" title="点击预览">
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
            @if(count($datas))
                @for($i=0;$i<$datas->limit-count($datas);++$i)
            <a href="" title="点击预览">
                <div class="prolist">
                    <div class="pro_one"><img src=""></div>
                    <div class="pname"><b>产品名称</b>
                        <div class="small">时间</div>
                    </div>
                </div>
            </a>
                @endfor
            @endif

            <div style="clear:both;"></div>
            <div style="margin-top:20px;">@include('person.common.page')</div>
        </div>
    </div>
@stop