@extends('member.main')
@section('content')
    <div class="mem_crumb">会员后台 / 账户首页</div>
    <div class="mem_chart">
        <div class="chart1">
            <div class="circle circle1"></div>
            <div class="chart_text">邮件消息</div>
        </div>
        <div class="chart1">
            <div class="circle circle2"></div>
            <div class="chart_text">公司</div>
        </div>
        <div class="chart1">
            <div class="circle circle3"></div>
            <div class="chart_text">订单</div>
        </div>
        <div class="mem_info">
            <div class="circle"><img src="/assets/images/person.png" style="width:50px;"></div>
            <div class="mem_user">MEMBER INFO<br>会员信息</div>
        </div>
    </div>
    <div class="company_info">
        <button class="companybtn companybtnpos">公司信息</button>
    </div>
@stop