@extends('home.main')
@section('content')
    <style>
        table { color:grey; }
        .btn { padding:5px 20px;border:1px solid lightgrey; }
    </style>

    <div class="about_con">
        <h3>网站介绍</h3>

        <h3>用户操作说明</h3>
        <h4 class="star">1> 普通用户</h4>
        <h4 class="star">2> 个人会员用户</h4>
        <h4 class="star">3> 企业会员用户</h4>
        <h4 class="star">4> 设计师用户</h4>
        <h4 class="star">5> 制作公司用户</h4>
        <h4 class="star">6> 娱乐公司用户</h4>
        <h4 class="star">7> 租赁公司用户</h4>

        <h3>交易流程</h3>
        <h4 class="star">视频流程</h4>
        <table>
            <tr><td colspan="10" height="10px"></td></tr>
            {{--<tr>--}}
                {{--<td class="btn">提供创意</td><td>==></td>--}}
                {{--<td class="btn">设计分镜</td><td>==></td>--}}
                {{--<td class="btn">确定样片</td><td>==></td>--}}
                {{--<td class="btn">成片定稿</td>--}}
            {{--</tr>--}}
        </table>
    </div>
@stop