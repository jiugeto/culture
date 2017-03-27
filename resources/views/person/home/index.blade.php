@extends('person.main')
@section('content')
    <div class="per_body" style="height:670px;">
        <div style="height:10px;">{{--空白--}}</div>
        {{--个人首页：选项依据：年龄（出生、满月、幼年、童年、少年、成年、中年、老年、寿终）；--}}
        {{--<br>节日（元旦、情人节、除夕、春节、元宵节、妇女节、植树节、315、愚人节、清明节、劳动节、儿童节、教师节、中秋节、国庆节、光棍节、感恩节、平安夜、圣诞节）--}}
        {{--<br>个人设置--}}

        <div class="per_menu">
            {{--s代表检索--}}
            片源类型:
            <select name="from">
                <option value="1" {{$from==1?'selected':''}}>我的创作</option>
                <option value="2" {{$from==2?'selected':''}}>我的视频</option>
                <option value="3" {{$from==2?'selected':''}}>我的设计</option>
            </select>

            <span class="right">
                @if($user['head'])
                <div class="userhead">
                    <img src="{{$user['head']}}" width="20">
                </div>
                @else
                <img src="{{PUB}}assets/images/person.png">
                @endif
                {{Session::has('user')?Session::get('user.username'):''}}
                <a href="{{DOMAIN}}person/space" class="userinfo">个人空间</a>
            </span>
        </div>

        {{--作品列表--}}
        {{--<div><br>注释：这里包括各种节日、庆典、生老病死，怀念等等</div>--}}
        <div class="per_work">
            @if(count($datas))
                @foreach($datas as $data)
            <a href="{{DOMAIN}}person/@if($from==1){{'goods'}}@else{{'product'}}@endif/{{$data['id']}}">
                <div class="per_waterfall">
                    <div class="img">
                    @if($data['thumb'])
                        <img src="{{$data['thumb']}}">
                    @endif
                    </div>
                    <p class="text">{{$data['name']}}</p>
                </div>
            </a>
                @endforeach
            @endif
            @if(count($datas)<16)
                @for($i=0;$i<16-count($datas);++$i)
            <a href="">
                <div class="per_waterfall">
                    <div class="img">无</div>
                    <p class="text">暂无</p>
                </div>
            </a>
                @endfor
            @endif
        </div>
    </div>

    {{--分页--}}
    <div style="margin:0 auto;margin-top:20px;width:1000px;">
        @include('person.common.page2')
    </div>
@stop