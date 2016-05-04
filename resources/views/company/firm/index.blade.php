@extends('company.main')
@section('content')
    <div class="com_firm">
        {{--<div class="title"><div>公司的服务</div></div>--}}
        {{--<p>服务的简单介绍...</p>--}}
        <div class="title"><div>{{ $firm?$firm->name:'无' }}</div></div>
        <p>{!! $firm?$firm->intro:'无' !!}</p>
        <div class="com_firm_con" style="height:@if(!count($datas)){{'0'}}@elseif(ceil(count($datas)/3)){{ceil(count($datas)/3)*400+20}}@endif px">
            <div style="height:20px;"></div>
            {{--<span>--}}
                {{--<div class="onlyone">--}}
                    {{--<div class="title">标题</div>--}}
                    {{--<div><img src="/uploads/images/2016/online1.png"></div>--}}
                    {{--<p>内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容</p>--}}
                    {{--<p>细节1</p>--}}
                    {{--<p>细节1</p>--}}
                    {{--<p>细节1</p>--}}
                {{--</div>--}}
            {{--</span>--}}
            @foreach($datas as $data)
            <span>
                <div class="onlyone">
                    <div class="title">{{ $data->name }}</div>
                    @if($data->pic_id)
                    <div><img src="{{ $data->pic()->url }}"></div>
                    @endif
                    <p>{{ strip_tags($data->intro) }}</p>
                    @if($data->small())
                        @foreach($data->small() as $small)<p>{{ $small }}</p>@endforeach
                    @endif
                </div>
            </span>
            @endforeach
        </div>
    </div>
@stop