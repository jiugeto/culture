@extends('company.main')
@section('content')
    <div class="com_firm">
        <div class="title"><div>{{count($datas)?$datas[0]['moduleName']:'无'}}</div></div>
        <p>{{count($datas)?$datas[0]['moduleIntro']:'无'}}</p>
        <div class="com_team_con">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="javascript:;">
                <div class="onlyone" id="div_{{$data['id']}}">
                    <div class="img">
                        @if($data['thumb'])<img src="{{$data['thumb']}}">@else图片待添加@endif
                    </div>
                    <div class="text">{{$data['name']}} <br>
                        <span style="font-size:12px;color:#808080;">{{$data['intro']}}</span>
                    </div>
                </div>
            </a>
                @endforeach
            @endif

            @if(count($datas)<6)
                @for($i=0;$i<6-count($datas);++$i)
            <a href="" title="">
                <div class="onlyone">
                    <div class="img">待添加</div>
                    {{--<div class="text">职员名称</div>--}}
                </div>
            </a>
                @endfor
            @endif
        </div>
    </div>
@stop