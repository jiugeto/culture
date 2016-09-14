@extends('company.main')
@section('content')
    <div class="com_about">
        <div class="crumb" style="padding:2px 10px;border-bottom:1px solid lightgrey;background:rgb(250,250,250);">
            公司{{ $data->type==3 ? '新闻' : '资讯' }}
            <span class="float_right">
                <a href="{{DOMAIN}}c/{{CID}}/about">关于公司</a> / 公司{{ $data->type==3 ? '新闻' : '资讯' }}
            </span>
        </div>
        <span class="left">
            <div class="about_con" style="width:1000px;text-align:center;">
                <div class="con">{{ $data->name }}
                    <span style="color:grey;font-size:12px;">({{ $data->createTime() }})</span>
                </div>
                <div class="con">
                    <img src="{{ $data->getPicUrl() }}" style="
                    @if($size=$data->getUserPicSize($data->pic(),$w=500,$h=150))
                            width:{{$size['w']}}px;height:{{$size['h']}}px;
                    @endif
                            ">
                </div>
                <div class="con">{!! $data->intro !!}</div>
            </div>
        </span>
    </div>
@stop