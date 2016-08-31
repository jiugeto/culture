@extends('company.main')
@section('content')
    <div class="com_about">
        <span class="left">
            <div class="about_con">
            @if(in_array($type,[1,2]))
                <div class="star">{{ $data->name }}</div>
                <div class="con">
                    <img src="{{ $data->getPicUrl() }}" style="
                         @if($size=$data->getUserPicSize($data->pic(),$w=500,$h=150))
                             width:{{$size}}px;height:150px;
                         @endif
                    ">
                </div>
                <div class="con">{!! $data->intro !!}</div>
            @elseif(in_array($type,[3,4]))
                <div class="star">{{ $type==3 ? '公司新闻' : '行业资讯' }}</div>
                @if(count($datas))
                    @foreach($datas as $data)
                <div class="newslist" title="点击进入 {{ $data->name }}"
                     onclick="window.location.href='{{DOMAIN}}c/{{CID}}/news/{{$data->id}}';">
                    <div class="img">
                    @if($data->pic_id)
                        <img src="{{ $data->getPicUrl() }}" style="
                            @if($size=$data->getUserPicSize($data->pic(),$w=100,$h=40))
                                width:{{$size}}px;height:40px;
                            @endif
                                ">
                    @else 待添加
                    @endif
                    </div>
                    <div class="text">{{ $data->name }}</div>
                    <div class="text" style="float:right;">{{ $data->createTime() }}</div>
                </div>
                    @endforeach
                @endif
            @endif
            </div>
        </span>
        <span class="right">
            <div class="about_a">
            @foreach($model['types'] as $ktype=>$vtype)
                @if($ktype==1)
                <div class="{{ $type==$ktype?'curr':'' }}"
                     onclick="window.location.href='{{DOMAIN}}c/{{CID}}/about';"> ▶ {{ '公司'.$vtype }}</div>
                @elseif(in_array($ktype,[2,3,4]))
                <div class="{{ $type==$ktype?'curr':'' }}"
                     onclick="window.location.href='{{DOMAIN}}c/{{CID}}/about/{{$ktype}}';"> ▶ {{ '公司'.$vtype }}</div>
                @endif
            @endforeach
            </div>
        </span>
    </div>
@stop