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
                <div class="star">{{ $datas->name }}</div>
                <div class="con">{!! $datas->intro !!}</div>
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