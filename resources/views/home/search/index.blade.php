@extends('home.main')
@section('content')
    @include('home.search.crumb')

    <div class="content" style="top:10px;">
        {{--<div class="s_search">00</div>--}}

        {{--<div style="padding-top:10px;height:1px;border-bottom:1px dashed rgb(240,240,240)"></div>--}}
        {{--<div style="height:10px;"></div>--}}

        <div class="searchlist">
            @if( count($datas))
                @foreach($datas as $data)
            <div class="waterfall" onclick="window.location.href='{{$datas->url.$data->id}}';">
                <div class="img">
                    <img src="
                    @if($searchGenre==1) {{ $data->getPicUrl() }}
                    @elseif($searchGenre==2) {{ $data->getPicUrl() }}
                    @elseif($searchGenre==3) {{ $data->getPicUrl() }}
                    @elseif($searchGenre==4) {{ $data->getPicUrl() }}
                    @elseif($searchGenre==5) {{ $data->getLogo() }}
                    @elseif($searchGenre==6) {{ $data->getPicUrl() }}
                    @elseif($searchGenre==7) {{ $data->getPicUrl() }}
                    @elseif($searchGenre==8) {{ $data->getPicUrl() }}
                    @elseif($searchGenre==9) {{ $data->getPicUrl() }}
                    @endif
                    " style="
                    @if($size=$data->getUserPicSize($data->pic(),$w=160,$h=165))
                            width:{{$size['w']}}px;height:{{$size['h']}}px;
                    @endif">
                </div>
                <div class="text">{{ $data->name }}</div>
                <div class="cname">
                    @if($searchGenre==1) 本站
                    @elseif($searchGenre>1)
                        @if($data->getCompanyName($data->uid)) {{ $data->getCompanyName($data->uid) }}
                        @else {{ $data->getUserName($data->uid) }}
                        @endif
                    @endif
                </div>
            </div>
                @endforeach
            @endif

            @if(count($datas)<$datas->limit)
                @for($i=0;$i<$datas->limit-count($datas);++$i)
            <div class="waterfall">
                <div class="img">+</div>
                <div class="text">某某名称</div>
                <div class="cname">公司名称</div>
            </div>
                @endfor
            @endif
        </div>
        @include('home.common.#page')
    </div>
@stop