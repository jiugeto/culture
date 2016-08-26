@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:1100px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">每日签到</p>
            <div class="list">
                <p class="user_info"><b>今日签到了么？将随机获取奖励：
                        <span class="red">{{ $datas->hasDay ? '完成签到' : '还未签到' }}</span></b></p>
                <p class="user_info">今天是：{{ date("Y年m月d日",time()) }} 星期 {{ $month['week'] }}</p>
                <div class="rili" style="height:{{ $month['count']==31 ? 560 : 470 }}px;">
                    @for($i=1;$i<$month['count']+1;++$i)
                    <div class="
                        @if($i<$month['day'])
                            overdue @if($status=$model->getSignStatus($uid,$month['date'].'-'.$i)){{ $status['code']==1?'due_curr':'' }}@endif
                        @elseif($i==$month['day']) oneday day_curr
                        @elseif($i>$month['day']) nodue
                        @endif
                    ">
                        <div class="title">{{ $i }}日</div>
                        @if($status=$model->getSignStatus($uid,$month['date'].'-'.$i))
                        <div class="signbtn {{ in_array($status['code'],[3,4])?'curr':'' }}" onclick="getSign({{ $i }})">{{ $status['name'] }}</div>
                        @endif
                    </div>
                    @endfor
                    <input type="hidden" name="today" value="{{ $month['day'] }}">
                </div>

                <div style="margin:20px auto;border-top:1px dashed ghostwhite;">{{--线--}}</div>
                <p class="user_info"><b>签到排行榜</b></p>
                <p class="user_info">按时间：
                    <a onclick="window.location.href='{{DOMAIN}}person/sign';" class="{{ $d=='' ? 'red' : 'blue' }}">当天签到</a> &nbsp;
                    <a onclick="window.location.href='{{DOMAIN}}person/sign/month';" class="{{ $d=='month' ? 'red' : 'blue' }}">当月签到</a> &nbsp;
                    <a onclick="window.location.href='{{DOMAIN}}person/sign/all';" class="{{ $d=='all' ? 'red' : 'blue' }}">总的签到</a>
                </p>
                <table class="usersign">
                    <tr>
                        <th>用户名称</th>
                        {{--<th>签到总天数</th>--}}
                        <th>今日签到时间</th>
                        <th>今日签到奖励</th>
                    </tr>
                    @if(count($datas))
                        @foreach($datas as $data)
                    <tr>
                        <td>{{ $data->getUName() }}</td>
                        {{--<td>{{ count($datas) }}</td>--}}
                        <td>{{ $data->createTime() }}</td>
                        <td>{{ $data->reward() }}</td>
                    </tr>
                        @endforeach
                    @else
                        <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                    @endif
                </table>
                @if(count($datas) > $datas->limit)
                <div style="margin-top:10px;">@include('person.common.page')</div>
                @endif
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