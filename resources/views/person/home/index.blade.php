@extends('person.main')
@section('content')
    <div class="per_body">
        <div style="height:10px;">{{--空白--}}</div>
        {{--个人首页：选项依据：年龄（出生、满月、幼年、童年、少年、成年、中年、老年、寿终）；--}}
        {{--<br>节日（元旦、情人节、除夕、春节、元宵节、妇女节、植树节、315、愚人节、清明节、劳动节、儿童节、教师节、中秋节、国庆节、光棍节、感恩节、平安夜、圣诞节）--}}
        {{--<br>个人设置--}}
        <div class="per_menu">
            片源:
            <a href="">在线创作</a>
            <a href="" class="curr">会员作品</a>
            &nbsp;&nbsp;
            找类型:
            <a href="">个人需求</a>
            {{--<select name="type">--}}
                {{--<option value="1">年龄</option>--}}
                {{--<option value="2">节日</option>--}}
            {{--</select>--}}
            {{--<span class="type1">--}}
                {{--<a href="">出生</a>--}}
                {{--<a href="">满月</a>--}}
            {{--</span>--}}
            {{--<span class="type2" style="display:none;">--}}
                {{--<a href="">元旦</a>--}}
                {{--<a href="">情人节</a>--}}
            {{--</span>--}}
            {{--<script>--}}
                {{--$(document).ready(function(){--}}
                    {{--var type = $("select[name='type']");--}}
                    {{--type.change(function(){--}}
                        {{--$(".type1").toggle();--}}
                        {{--$(".type2").toggle();--}}
                    {{--});--}}
                {{--});--}}
            {{--</script>--}}

            <span class="right">
                <img src="{{DOMAIN}}assets/images/person.png">
                {{ \Session::has('user') ? \Session::get('user.username') : '' }}
                <a href="{{DOMAIN}}person/setting">个人资料</a>
            </span>
        </div>
        {{--<div><br>注释：这里包括各种节日、庆典、生老病死，怀念等等</div>--}}
        <div class="per_work">
            <div class="per_waterfall">
                <div class="img">
                    <img src="{{DOMAIN}}uploads/images/2016/online1.png">
                </div>
                <p class="text">000000000</p>
            </div>
            <div class="per_waterfall">
                <div class="img">
                    <img src="{{DOMAIN}}uploads/images/2016/online1.png">
                </div>
                <p class="text">000000000</p>
            </div>
        </div>
    </div>
@stop