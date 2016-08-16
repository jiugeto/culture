@extends('person.main')
@section('content')
    <div class="per_body">
        <div style="height:10px;">{{--空白--}}</div>
        {{--个人首页：选项依据：年龄（出生、满月、幼年、童年、少年、成年、中年、老年、寿终）；--}}
        {{--<br>节日（元旦、情人节、除夕、春节、元宵节、妇女节、植树节、315、愚人节、清明节、劳动节、儿童节、教师节、中秋节、国庆节、光棍节、感恩节、平安夜、圣诞节）--}}
        {{--<br>个人设置--}}

        <div class="per_menu">
            {{--s代表检索--}}
            片源类型:
            <select name="from">
                <option value="1" {{ $from==1 ? 'selected' : '' }}>在线创作</option>
                <option value="2" {{ $from==2 ? 'selected' : '' }}>会员作品</option>
            </select>
            <a href="{{DOMAIN}}person/s/{{$from}}/0" class="{{ $type==0 ? 'curr' : '' }}">所有</a>
            @if($from==1)
                @foreach($goodsModel['types'] as $ktype=>$vtype)
                    @if(in_array($ktype,[2,4]))
                    <a href="{{DOMAIN}}person/s/{{$from}}/{{$ktype}}" class="{{ $type==$ktype ? 'curr' : '' }}">{{ mb_substr($vtype,0,mb_strlen($vtype)-2,'utf-8') }}</a>
                    @endif
                @endforeach
            @elseif($from==2)
                @foreach($productModel['genres'] as $kgenre=>$vgenre)
                    <a href="{{DOMAIN}}person/s/{{$from}}/{{ $kgenre }}" class="{{ $type==$kgenre ? 'curr' : '' }}">{{ mb_substr($vgenre,0,mb_strlen($vgenre)-2,'utf-8') }}</a>
                @endforeach
            @endif
            <script>
                $("select[name='from']").change(function(){
                    if ($(this).val()==1) {
                        window.location.href = '{{DOMAIN}}person';
                    } else if ($(this).val()==2) {
                        window.location.href = '{{DOMAIN}}person/s/2/0';
                    }
                });
            </script>

            <span class="right">
                <img src="{{DOMAIN}}assets/images/person.png">
                {{ \Session::has('user') ? \Session::get('user.username') : '' }}
                <a href="{{DOMAIN}}person/space" class="userinfo">个人资料</a>
            </span>
        </div>

        {{--作品列表--}}
        {{--<div><br>注释：这里包括各种节日、庆典、生老病死，怀念等等</div>--}}
        <div class="per_work">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="{{DOMAIN}}person/@if($from==1){{'goods'}}@else{{'product'}}@endif/{{ $data->id }}">
                <div class="per_waterfall" {{--onclick="window.location.href='';"--}}>
                    <div class="img">
                        {{--<img src="{{DOMAIN}}uploads/images/2016/online1.png">--}}
                        <img src="{{ $data->getPicUrl() }}" style="@if($size=$data->getPicSize($w=148,$h=100))width:{{$size}}px;@endif height:120px;">
                        {{--<div style="width:220px;height:120px;background:rgb(240,240,240);"></div>--}}
                    </div>
                    <p class="text">{{ $data->name }}</p>
                </div>
            </a>
                @endforeach
            @endif
            @if(count($datas)<16)
                @for($i=0;$i<16-count($datas);++$i)
            <a href="">
                <div class="per_waterfall" {{--onclick="window.location.href='';"--}}>
                    <div class="img">
                        {{--<img src="{{DOMAIN}}uploads/images/2016/online1.png">--}}
                        <div style="width:220px;height:120px;background:rgb(240,240,240);"></div>
                    </div>
                    <p class="text">暂无</p>
                </div>
            </a>
                @endfor
            @endif
        </div>
    </div>

    {{--分页--}}
    <div style="margin:0 auto;margin-top:20px;width:1000px;">
        @include('person.common.page')
    </div>
@stop