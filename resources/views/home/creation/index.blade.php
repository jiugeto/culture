@extends('home.main')
@section('content')
    @include('home.common.crumb')
    {{-- 在线作品模板 --}}
    <div class="cre_content">
        {{-- 用户类型 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="cre_select">
            <button class="cre_gener">普通用户 | 免费 <img src="/assets-home/images/gener_x.png"></button>
            <button class="cre_jiantou1">=></button>
            <button class="cre_per">个人会员 | 免费 <img src="/assets-home/images/person_x.png"></button>
            <button class="cre_jiantou2">=></button>
            <button class="cre_com">企业会员 | 免费 <img src="/assets-home/images/company_x.png"></button>
        </div>

        {{-- 片源类型 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="cre_cate">
            <p class="title"><b>片源类型</b></p>
            <div class="cate">
                <div class="img"><img src="/upload/images/online1.png"></div>
                <p class="title">体会过副本</p>
                <p>提货人公分你是他如何规范内部</p>
            </div>
        </div>

        {{-- 在线片源 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="cre_source">
            <div class="source">
                <div class="title"><b>最新上线</b></div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
                <div class="cre_con">
                    <div class="img"><img src="/upload/images/online1.png"></div>
                    <div class="text">热带风暴VC</div>
                </div>
            </div>
        </div>
    </div>
@stop