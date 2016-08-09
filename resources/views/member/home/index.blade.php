@extends('member.main')
@section('content')
    <div class="mem_crumb">会员后台 / 账户首页</div>
    <div class="mem_chart">
        <div class="chart1">
            <div class="circle circle1">
                <canvas id="one" width="40" height="40"></canvas>
                <div class="text" style="@if($userInfo['per']<10)left:12px;@endif">{{ $userInfo['per'] }}%</div>
                <input type="hidden" id="onePer" value="{{ $userInfo['per']/100 }}">
            </div>
            <div class="chart_text">个人 <a style="font-size:12px;position:relative;">详情</a></div>
        </div>
        <div class="chart1">
            <div class="circle circle2">
                <canvas id="two" width="40" height="40"></canvas>
                <div class="text" style="@if($companyInfo['per']<10)left:12px;@endif">{{ $companyInfo['per'] }}%</div>
                <input type="hidden" id="twoPer" value="{{ $companyInfo['per']/100 }}">
            </div>
            <div class="chart_text">公司</div>
        </div>
        <div class="chart1">
            <div class="circle circle3">
                <canvas id="three" width="40" height="40"></canvas>
                <div class="text" style="@if($orderInfo['per']<10)left:12px;@endif">{{ $orderInfo['per'] }}%</div>
                <input type="hidden" id="threePer" value="{{ $orderInfo['per']/100 }}">
            </div>
            <div class="chart_text">订单</div>
        </div>
        <div class="mem_info">
            <div class="circle"><img src="/assets/images/person.png" style="width:40px;"></div>
            <div class="mem_user">MEMBER INFO<br>{{ Session::get('user.username') }}</div>
            <div class="detail">详情</div>
            <div class="userInfoDetail">
            @if($user=$userInfo['user'])
                <div>用户名：{{ $user->username }}</div>
                <div>Email：<br><span style="font-size:12px;">{{ $user->email }}</span></div>
                <div>QQ：{{ $user->qq }}</div>
                <div>手机：{{ $user->mobile }}</div>
                <div>地址：<br><span style="font-size:12px;">{{ $user->address }}</span></div>
                <div>上次登录：<br><span style="font-size:12px;">{{ $user->lastLogin() }}</span></div>
                <div>&nbsp;</div>
                <a class="close" style="bottom:20px;left:0;" onclick="$('.userInfoDetail').hide();">关闭</a>
            @endif
            </div>
        </div>
        {{--加载圆环的js函数--}}
        <script src="{{DOMAIN}}assets-home/js/ring.js"></script>
        <script>
            //圆环1
            drawCircle({
                id: 'one',
                color: 'white',
                angle: $("#onePer").val(),
                lineWidth: 3
            });
            //圆环2
            drawCircle({
                id: 'two',
                color: 'white',
                angle: $("#twoPer").val(),
                lineWidth: 3
            });
            //3
            drawCircle({
                id: 'three',
                color: 'white',
                angle: $("#threePer").val(),
                lineWidth: 3
            });

            $(".detail").click(function(){
                $(".userInfoDetail").toggle();
            });
        </script>
    </div>
    <div class="company_info">
        <button class="companybtn companybtnpos" onclick="$('.company_detail').toggle();">详细信息</button>
    </div>
    @if($company=$companyInfo['company'])
    <div class="company_detail">
        <div>公司名称：{{ $company->name }}</div>
        <div>企业类型：{{ $company->genreName() }}</div>
        <div>所在地区：{{ $company->getAreaName() }}</div>
        <div>营业执照编号：{{ $company->yyzzid }}</div>
        <div>服务电话：{{ $company->tel }}</div>
        <div>企业QQ：{{ $company->qq }}</div>
        <div>公司网址：{{ $company->web }}</div>
        <div>传真：{{ $company->fax }}</div>
        <div>企业邮箱：{{ $company->email }}</div>
        <a class="close" onclick="$('.company_detail').hide();">关闭</a>
    </div>
    @endif
@stop