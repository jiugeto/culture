@extends('member.main')
@section('content')
    <div class="vip-body col-sm-offset-3 menu" style="position:relative;left:-90px;">
        <div class="breadcrumb_color-vip">
            <img src="images/daohang-white.png">
            <a>账户首页</a>
        </div>
        <div>
            <div class="zhangsan-body">
                <div class="zhangsan-body-left">
                    <div style="padding-top:5px;">
                        <a href="{{ url('/member/setting/personcheck') }}" title="个人信息验证" style="text-decoration:none;">
                            <img src="{{ asset('images') }}/t1.png">
                        </a>
                        <a href="" title="手机验证" style="text-decoration:none;">
                            <img src="{{ asset('images') }}/t2.png">
                        </a>
                        <a href="" title="邮箱验证" style="text-decoration:none;">
                            <img src="{{ asset('images') }}/t3.png">
                        </a>
                        {{--@if($data['iscompany'])
                            <a href="{{ url('/member/setting/companycheck') }}" title="企业验证" style="text-decoration:none;">
                                <img src="{{ asset('images') }}/t4.png">
                            </a>
                        @endif--}}
                    </div>
                    <br>
                    {{--@include('member.company.circle')--}}
                    <a href="
                        {{--@if($data['cid']) {{ url('/member/order/true') }}
                        @else {{ url('/member/order/true') }}
                        @endif--}}
                            " style="position:relative;left:450px;top:-40px;">
                        <h6>详情</h6></a>
                </div>
                <div class="vip-zhu vip-fix">{{--位置调动--}}
                    <img src="{{ asset('images') }}/touxiang.png"  class="vip-zhu-img">
                    <div class="vip-zhu-span">{{--{{ $data['username'] }}--}}<br>
                        {{--@if($data['isauth'])
                            认证状态：<span class="vip">已认证</span>
                        @else
                            认证状态：未认证
                        @endif--}}
                    </div>
                    {{--@if($data['isauth'])
                        @if($data['person']['per']==100)
                            <p class="vip-red">您是已认证会员！</p>
                            <div class="vip-fix-grxq" id="person" style="cursor:pointer;" title="点击查看详情">个人详情
                            </div>
                            <div id="personinfo" style="display:none;">
                                <div class="vip-fix-xm">用户名：{{ $data['username'] }}</div>
                                <div class="vip-fix-xm">Email：{{ $data['email'] }}</div>
                                <div class="vip-fix-xm">手机号码：{{ $data['mobile'] }}</div>
                                @if($data['userperson'])
                                    <div class="vip-fix-xm">真实名字：{{ $data['userperson']['realname'] }}</div>
                                    <div class="vip-fix-xm">性别：{{ $data['userperson']['sex']==1 ? '男' : '女' }}</div>
                                    <div class="vip-fix-xm">地址：{{ $data['userperson']['origin'] }}</div>
                                @endif
                            </div>
                            <script>
                                $(document).ready(function(){
                                    $("#person").click(function(){
                                        $("#personinfo").toggle();
                                    });
                                });
                            </script>
                        @elseif($data['person']['num'])
                            <p class="vip-red">您是已注册的会员！</p>
                            <div class="vip-fix-grxq" id="person" style="cursor:pointer;" title="点击查看已有详情">
                                资料未完善
                            </div>
                            <div id="personinfo" style="display:none;">
                                @if($data['userperson'])
                                    @if($data['userperson']['realname'])<div class="vip-fix-xm">姓名：{{ $data['userperson']['realname'] }}</div>@endif
                                @endif
                            </div>
                            <script>
                                $(document).ready(function(){
                                    $("#person").click(function(){
                                        $("#personinfo").toggle();
                                    });
                                });
                            </script>
                        @endif
                    @else
                        <p class="vip-red">是否认证：非认证用户</p>
                        <a href="{{ url('/member/setting/personcheck') }}" class="vip-zhu-lijikaitong">立即开通</a>
                    @endif--}}
                </div>
            </div>
        </div>
        <div class="youhuanjianyi-borderb">
            <div class="youhuanjianyi-next">
               {{-- @if($data['person']['per']==100)
                    <img src="{{ asset('images') }}/gantanhao.png">
                    <h class="youhuanjianyi-next-h1">个人信息</h>
                    <img src="{{ asset('images') }}/duihao.png" class="duihao-img">
                @elseif($data['person']['num'])
                    <img src="{{ asset('images') }}/gantanhao.png">
                    <h class="youhuanjianyi-next-h1">完善个人信息</h>
                    <h class="youhuanjianyi-next-h2">资料不全，可以方便用户更快找到您。</h>
                    <a href="{{ url('/member/setting/personcheck') }}"><button class="lijitianxie-btn">立即完善</button></a>
                @else
                    <img src="{{ asset('images') }}/gantanhao.png">
                    <h class="youhuanjianyi-next-h1">填写个人信息</h>
                    <h class="youhuanjianyi-next-h2">填写个人信息并上传头像，可以方便用户更快找到您。</h>
                    <a href="{{ url('/member/setting/personcheck') }}"><button class="lijitianxie-btn">立即填写</button></a>
                @endif--}}
            </div>
            <hr>
            <div class="youhuanjianyi-next">
                {{--@if($data['cid'] && $data['usercompany'])
                    @if($data['company']['per']==100)
                        <img src="{{ asset('images') }}/gantanhao.png">
                        <h class="youhuanjianyi-next-h1">公司信息</h>
                        <img src="{{ asset('images') }}/duihao.png" class="duihao-img">
                    @elseif($data['company']['num'])
                        <img src="{{ asset('images') }}/gantanhao.png">
                        <h class="youhuanjianyi-next-h1">完善公司信息</h>
                        <h class="youhuanjianyi-next-h2">资料不全，可以方便用户更快找到您。</h>
                        <a href="{{ url('/member/setting/companycheck') }}"><button class="lijitianxie-btn">立即完善</button></a>
                    @else
                        <img src="{{ asset('image') }}/gantanhao.png">
                        <h class="youhuanjianyi-next-h1">填写公司信息</h>
                        <h class="youhuanjianyi-next-h2">填写公司信息并上传头像，可以方便用户更快找到您。</h>
                        <a href="{{ url('/member/setting/companycheck') }}"><button class="lijitianxie-btn">立即填写</button></a>
                    @endif
                @endif--}}
            </div>
        </div>
    </div>
@stop