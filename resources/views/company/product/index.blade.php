@extends('company.main')
@section('content')
    <div class="com_product">
        {{--<p class="crumb"><b>导航：</b>产品类别 > 视频 > 宣传片</p>--}}
        <div class="com_tab">
            <b>{{$curr=='product'?'样片':'花絮'}}类型：</b><br>
            <div onclick="window.location.href='{{DOMAIN}}c/{{$company['id']}}/{{$curr}}';"
                 class="link {{$cate==0?'curr':''}}">所有类型</div>
            @foreach($model['cates'] as $k=>$vcate)
                <div onclick="window.location.href='{{DOMAIN}}c/{{$company['id']}}/{{$curr}}/s/{{$k}}';"
                   class="link {{$cate==$k?'curr':''}}">{{$vcate}}</div>
            @endforeach
        </div>
        <div class="com_list">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="javascript:;" onclick="alert('点击看视频！');">
                <div class="com_pro" title="点击开始预览 {{$data['name']}}">
                    <div class="img">
                        <img src="{{$data['thumb']}}">
                    </div>
                    <div class="text">{{$data['name']}}</div>
                </div>
            </a>
                @endforeach
            @endif
            @if(count($datas)<20)
                @for($i=0;$i<20-count($datas);++$i)
                <div class="com_pro">
                    <div class="img">待添加</div>
                    <div class="text">视频名称</div>
                </div>
                @endfor
            @endif
        </div>
        @include('company.common.page2')
    </div>
@stop