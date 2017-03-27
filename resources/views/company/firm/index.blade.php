@extends('company.main')
@section('content')
    <div class="com_firm">
        <div class="title"><div>{{count($datas)?$datas[0]['name']:'无'}}</div></div>
        <p>{{count($datas)?$datas[0]['intro']:'无'}}</p>
        <div class="com_firm_con" style="height:{{ceil($pagelist['total']/3)*400+20}}px">
            <div style="height:20px;"></div>
            @if(count($datas))
            @foreach($datas as $data)
            <span>
                <div class="onlyone">
                    <div class="title">{{$data['name']}}</div>
                    @if($data['thumb'])
                    <div class="img"><img src="{{$data['thumb']}}"></div>
                    @else <div class="img">待添加</div>
                    @endif
                    <p>{{strip_tags($data['intro'])}}</p>
                    @if($data['small'])
                        @foreach($data['small'] as $small)<p>{{$small}}</p>@endforeach
                    @endif
                </div>
            </span>
            @endforeach
            @endif

            @if(count($datas)<$pagelist['total'])
                @for($i=0;$i<$pagelist['total']-count($datas);++$i)
            <span>
                <div class="onlyone">
                    <div class="title">标题</div>
                    <div class="img">待添加</div>
                    <p>内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容</p>
                    <p>细节1</p>
                    <p>细节1</p>
                    <p>细节1</p>
                </div>
            </span>
                @endfor
            @endif
        </div>
    </div>
@stop