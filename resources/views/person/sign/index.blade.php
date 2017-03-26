@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">每日签到</p>
            <div class="list" style="width:748px;">
                <p class="user_info"><b>今日签到了么？将随机获取奖励：
                        <span class="red">{{$hasDay ? '完成签到' : '还未签到'}}</span>
                    </b></p>
                <p class="user_info">今天是：
                    {{date("Y年m月d日",time())}} 星期 {{date('w',time())}}
                </p>
                <table class="rili">
                    <tr>
                        <th style="background:#d9d9d9;">日</th>
                        <th>一</th>
                        <th>二</th>
                        <th>三</th>
                        <th>四</th>
                        <th>五</th>
                        <th style="background:#d9d9d9;">六</th>
                    </tr>
                    @foreach($months as $month)
                    <tr>
                        <td @if(isset($month[0])&&$m=$month[0])
                            style="
                                {{$m['hasSign']?'color:#ffffff;background:#64c8ff;':
                                'background:#e5e5e5;'}}
                                {{date('d',time())==$m['day']?'color:#ff4466;':''}}
                                "
                            title="@if($m['hasSign'])已签到成功
                                @else{{$m['day']>=date('d',time())?'点击签到拿奖励':'已过期'}}
                                @endif"
                            onclick="getSign({{$m['day']}})"
                            @else style="background:#e5e5e5;"
                            @endif
                            >
                            @if(isset($month[0])&&$month[0]['week']==0&&$m=$month[0])
                                {{$m['day']}}<br><span style="font-size:12px;">
                                    {{$m['hasSign']?'已签到':'未签到'}}</span>
                            @else &nbsp;
                            @endif
                        </td>
                        <td @if(isset($month[1])&&$m=$month[1])
                            style="
                                {{$m['hasSign']?'color:#ffffff;background:#64c8ff;':
                                'background:#f7f7f7;'}}
                                {{date('d',time())==$m['day']?'color:#ff4466;':''}}
                                "
                            title="@if($m['hasSign'])已签到成功
                                @else{{$m['day']>=date('d',time())?'点击签到拿奖励':'已过期'}}
                                @endif"
                            onclick="getSign({{$m['day']}})"
                            @endif
                            >
                            @if(isset($month[1])&&$month[1]['week']==1&&$m=$month[1])
                                {{$m['day']}}<br><span style="font-size:12px;">
                                    {{$m['hasSign']?'已签到':'未签到'}}</span>
                            @else &nbsp;
                            @endif
                        </td>
                        <td @if(isset($month[2])&&$m=$month[2])
                            style="
                                {{$m['hasSign']?'color:#ffffff;background:#64c8ff;':
                                'background:#f7f7f7;'}}
                                {{date('d',time())==$m['day']?'color:#ff4466;':''}}
                                "
                            title="@if($m['hasSign'])已签到成功
                                @else{{$m['day']>=date('d',time())?'点击签到拿奖励':'已过期'}}
                                @endif"
                            onclick="getSign({{$m['day']}})"
                            @endif
                            >
                            @if(isset($month[2])&&$month[2]['week']==2&&$m=$month[2])
                                {{$m['day']}}<br><span style="font-size:12px;">
                                    {{$m['hasSign']?'已签到':'未签到'}}</span>
                            @else &nbsp;
                            @endif
                        </td>
                        <td @if(isset($month[3])&&$m=$month[3])
                            style="
                                {{$m['hasSign']?'color:#ffffff;background:#64c8ff;':
                                'background:#f7f7f7;'}}
                                {{date('d',time())==$m['day']?'color:#ff4466;':''}}
                                "
                            title="@if($m['hasSign'])已签到成功
                                @else{{$m['day']>=date('d',time())?'点击签到拿奖励':'已过期'}}
                                @endif"
                            onclick="getSign({{$m['day']}})"
                            @endif
                            >
                            @if(isset($month[3])&&$month[3]['week']==3&&$m=$month[3])
                                {{$m['day']}}<br><span style="font-size:12px;">
                                    {{$m['hasSign']?'已签到':'未签到'}}</span>
                            @else &nbsp;
                            @endif
                        </td>
                        <td @if(isset($month[4])&&$m=$month[4])
                            style="
                                {{$m['hasSign']?'color:#ffffff;background:#64c8ff;':
                                'background:#f7f7f7;'}}
                                {{date('d',time())==$m['day']?'color:#ff4466;':''}}
                                "
                            title="@if($m['hasSign'])已签到成功
                                @else{{$m['day']>=date('d',time())?'点击签到拿奖励':'已过期'}}
                                @endif"
                            onclick="getSign({{$m['day']}})"
                            @endif
                            >
                            @if(isset($month[4])&&$month[4]['week']==4&&$m=$month[4])
                                {{$m['day']}}<br><span style="font-size:12px;">
                                    {{$m['hasSign']?'已签到':'未签到'}}</span>
                            @else &nbsp;
                            @endif
                        </td>
                        <td @if(isset($month[5])&&$m=$month[5])
                            style="
                                {{$m['hasSign']?'color:#ffffff;background:#64c8ff;':
                                'background:#f7f7f7;'}}
                                {{date('d',time())==$m['day']?'color:#ff4466;':''}}
                                "
                            title="@if($m['hasSign'])已签到成功
                                @else{{$m['day']>=date('d',time())?'点击签到拿奖励':'已过期'}}
                                @endif"
                            onclick="getSign({{$m['day']}})"
                            @endif
                            >
                            @if(isset($month[5])&&$month[5]['week']==5&&$m=$month[5])
                                {{$m['day']}}<br><span style="font-size:12px;">
                                    {{$m['hasSign']?'已签到':'未签到'}}</span>
                            @else &nbsp;
                            @endif
                        </td>
                        <td @if(isset($month[6])&&$m=$month[6])
                            style="
                                {{$m['hasSign']?'color:#ffffff;background:#64c8ff;':
                                'background:#e5e5e5;'}}
                                {{date('d',time())==$m['day']?'color:#ff4466;':''}}
                                "
                            title="@if($m['hasSign'])已签到成功
                                @else{{$m['day']>=date('d',time())?'点击签到拿奖励':'已过期'}}
                                @endif"
                            onclick="getSign({{$m['day']}})"
                            @else style="background:#e5e5e5;"
                            @endif
                            >
                            @if(isset($month[6])&&$month[6]['week']==6&&$m=$month[6])
                                {{$m['day']}}<br><span style="font-size:12px;">
                                    {{$m['hasSign']?'已签到':'未签到'}}</span>
                            @else &nbsp;
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div style="margin:20px auto;border-top:1px dashed ghostwhite;">{{--线--}}</div>
                <p class="user_info"><b>签到排行榜</b></p>
                {{--<p class="user_info">按时间：--}}
                    {{--<a onclick="window.location.href='{{DOMAIN}}person/sign';"--}}
                       {{--class="{{$date=='' ? 'red' : 'blue'}}">当天签到</a> &nbsp;--}}
                    {{--<a onclick="window.location.href='{{DOMAIN}}person/sign/month';"--}}
                       {{--class="{{$date=='month' ? 'red' : 'blue'}}">当月签到</a> &nbsp;--}}
                    {{--<a onclick="window.location.href='{{DOMAIN}}person/sign/all';"--}}
                       {{--class="{{$date=='all' ? 'red' : 'blue'}}">总的签到</a>--}}
                {{--</p>--}}
                <table class="usersign">
                    <tr>
                        <th>用户名称</th>
                        <th>签到时间</th>
                        <th>签到奖励</th>
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
    <input type="hidden" name="today" value="{{date('d',time())}}">

    <script>
        function getSign(day){
            var today = $("input[name='today']").val();
            if (day<today) {
                alert('时间过期，点击无效！'); return;
            } else if (day==today) {
                window.location.href = '{{DOMAIN}}person/sign/add';
            } else if (day>today) {
                alert('未来日期，还未开始！'); return;
            }
        }
    </script>
@stop