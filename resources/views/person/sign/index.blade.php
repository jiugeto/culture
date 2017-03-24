@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1100px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">每日签到</p>
            <div class="list" style="width:748px;">
                <p class="user_info"><b>今日签到了么？将随机获取奖励：
                        <span class="red">{{$hasDay ? '完成签到' : '还未签到'}}</span></b></p>
                <p class="user_info">今天是：{{date("Y年m月d日",time())}} 星期 {{date('w',time())}}</p>
                <table class="rili">
                    <tr>
                        <th>日</th>
                        <th>一</th>
                        <th>二</th>
                        <th>三</th>
                        <th>四</th>
                        <th>五</th>
                        <th>六</th>
                    </tr>
                    @foreach($months as $month)
                    <tr>
                        <td class="{{(isset($month[0])&&date('d',time()))==$month[0]['day'])?'today':''}}">
                            {{(isset($month[0])&&$month[0]['week']==0)?$month[0]['day']:"&nbsp;"}}</td>
                        <td>{{(isset($month[1])&&$month[1]['week']==1)?$month[1]['day']:"&nbsp;"}}</td>
                        <td>{{(isset($month[2])&&$month[2]['week']==2)?$month[2]['day']:"&nbsp;"}}</td>
                        <td>{{(isset($month[3])&&$month[3]['week']==3)?$month[3]['day']:"&nbsp;"}}</td>
                        <td>{{(isset($month[4])&&$month[4]['week']==4)?$month[4]['day']:"&nbsp;"}}</td>
                        <td>{{(isset($month[5])&&$month[5]['week']==5)?$month[5]['day']:"&nbsp;"}}</td>
                        <td>{{(isset($month[6])&&$month[6]['week']==6)?$month[6]['day']:"&nbsp;"}}</td>
                    </tr>
                    @endforeach
                </table>

                <div style="margin:20px auto;border-top:1px dashed ghostwhite;">{{--线--}}</div>
                <p class="user_info"><b>签到排行榜</b></p>
                <p class="user_info">按时间：
                    {{--<a onclick="window.location.href='{{DOMAIN}}person/sign';" class="{{ $d=='' ? 'red' : 'blue' }}">当天签到</a> &nbsp;--}}
                    {{--<a onclick="window.location.href='{{DOMAIN}}person/sign/month';" class="{{ $d=='month' ? 'red' : 'blue' }}">当月签到</a> &nbsp;--}}
                    {{--<a onclick="window.location.href='{{DOMAIN}}person/sign/all';" class="{{ $d=='all' ? 'red' : 'blue' }}">总的签到</a>--}}
                </p>
                <table class="usersign">
                    <tr>
                        <th>用户名称</th>
                        <th>今日签到时间</th>
                        <th>今日签到奖励</th>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                    <tr>
                        <td>{{$data['username']}}</td>
                        <td>{{$data['createTime']}}</td>
                        <td>{{$data['reward']}}</td>
                    </tr>
                        @endforeach
                    @else
                        <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                    @endif
                </table>
                @include('person.common.page2')
            </div>
        </div>
        @include('person.common.head')
    </div>

    <script>
        function getSign(day){
            var today = $("input[name='today']").val();
            if (day<today) {
                alert('已是过去日期，点击无效！'); return;
            } else if (day==today) {
                window.location.href = '{{DOMAIN}}person/sign/add/'+day;
            } else if (day>today) {
                alert('未来日期，还未开始！'); return;
            }
        }
    </script>
@stop