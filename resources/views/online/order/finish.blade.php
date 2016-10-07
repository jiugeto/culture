@extends('online.main')
@section('content')
    <div class="online_list" style="height:900px;background:rgb(40,40,40);">
        @include('online.order.menu')

        <div class="list">
            @if(count($datas))
                @foreach($datas as $data)
                    <a href="{{DOMAIN}}online/u/order/pre/{{$data->id}}/{{$data->video_id}}" target="_blank">
                        <div class="prolist">
                            <div class="pro_one">
                                <img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getUserPicSize($data->pic($data->gif),$w=200,$h=150))width:{{$size['w']}}px;height:{{$size['h']}}px; @endif">
                            </div>
                            <div class="pname"><b>{{ $data->getProductName() }}</b>
                                @if($data->is_new==1)<span style="color:red;float:left;">新</span>@endif
                                {{--<span style="float:right;" title="下载该视频">下载</span>--}}
                                <div class="small">{{ date("Y年m月",$data->created_at) }}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
            @for($i=0;$i<$datas->limit-count($datas);++$i)
                <a href="">
                    <div class="prolist">
                        <div class="pro_one">+</div>
                        <div class="pname"><b>产品名称</b>
                            {{--<span style="color:red;float:left;">新</span>--}}
                            {{--<span style="float:right;">下载</span>--}}
                            <div class="small">时间</div>
                        </div>
                    </div>
                </a>
            @endfor

            @if(count($datas)>$datas->total())
            <div style="clear:both;"></div>
            <div style="margin-top:20px;">@include('person.common.page')</div>
            @endif
        </div>
    </div>
@stop