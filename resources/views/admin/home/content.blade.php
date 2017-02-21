{{-- 后台首页模板 --}}


<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>一些常用模块</small></div>
    </div>
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list">
        <li><a href="{{DOMAIN}}admin/user" class="am-text-secondary">
                <span class="am-icon-btn am-icon-user-md"></span>
                <br/>今日/一周内/注册用户<br/> {{$users['day']}}/{{$users['week']}}/{{$users['all']}}
            </a>
        </li>
        <li><a href="{{DOMAIN}}admin/order" class="am-text-warning">
                <span class="am-icon-btn am-icon-briefcase"></span>
                <br/>创作/主体订单<br/> {{count($orders['create'])}}/{{count($orders['main'])}}
            </a>
        </li>
    </ul>

    {{--用户列表--}}
    <div class="am-g" style="margin-top:50px;padding-top:10px;border-top:1px solid ghostwhite;">
        <div class="am-u-sm-12">
            <p><b>最新用户(周)</b></p>
            <table class="am-table am-table-bd am-table-striped admin-content-table">
                <thead>
                <tr>
                    <th>ID</th><th>用户名</th><th>身份类型</th><th>登录时间</th><th>管理</th>
                </tr>
                </thead>
                <tbody>
                @if(count($users['datas']))
                    @foreach($users['datas'] as $data)
                <tr>
                    <td>{{ $data['id'] }}</td>
                    <td>{{ $data['username'] }}</td>
                    <td><a href="#">{{ $data['userType'] }}</a></td>
                    <td><span class="am-badge am-badge-success">{{ $data['createTime'] }}</span></td>
                    <td>
                        <div class="am-dropdown" data-am-dropdown>
                            <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                            <ul class="am-dropdown-content">
                                <li><a href="{{DOMAIN}}admin/user/{{$data['id']}}">查看</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                    @endforeach
                @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="am-g" style="margin-top:50px;padding-top:10px;border-top:1px solid ghostwhite;">
        {{--横向列表--}}
        <div class="am-u-md-6">
            {{--创作订单--}}
            <div class="am-panel am-panel-default">
                <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">创作订单<span class="am-icon-chevron-down am-fr" ></span></div>
                <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
                    <table style="width:100%;font-size:14px;">
                        <tr>
                            <td>编号</td>
                            <td>申请方</td>
                            <td>价格(元)</td>
                            <td>状态</td>
                            <td>时间</td>
                            <td>操作</td>
                        </tr>
                        <tr><td colspan="10" style="border-top:1px solid lightgrey;"></td></tr>
                        @if(count($orders['create']))
                            @foreach($orders['create'] as $order)
                            <tr>
                                <td>{{$order['id']}}</td>
                                <td>{{$order['uname']}}</td>
                                <td>{{$order['money']}}</td>
                                <td>{{$order['statusName']}}</td>
                                <td>{{$order['createTime']}}</td>
                                <td><a href="{{DOMAIN}}admin/orderpro/{{$order['id']}}"
                                       class="am-btn am-btn-default am-btn-xs" style="padding:3px 15px;">查看</a></td>
                            </tr>
                            @endforeach
                        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        {{--横向列表：创意、分镜、样片等等主体业务订单--}}
        <div class="am-u-md-6">
            <div class="am-panel am-panel-default">
                <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">交易订单<span class="am-icon-chevron-down am-fr" ></span></div>
                <div class="am-panel-bd am-collapse am-in" id="collapse-panel-2">
                    <table style="width:100%;font-size:14px;">
                        <tr>
                            <td>编号</td>
                            <td>申请方</td>
                            <td>发布方</td>
                            <td>价格(元)</td>
                            <td>状态</td>
                            <td>时间</td>
                            <td>操作</td>
                        </tr>
                        <tr><td colspan="10" style="border-top:1px solid lightgrey;"></td></tr>
                        @if(count($orders['main']))
                            @foreach($orders['main'] as $order)
                        <tr>
                            <td>{{$order['id']}}</td>
                            <td>{{UserNameById($order['uid'])}}</td>
                            <td>{{$order['sellerName']}}</td>
                            <td>{{$order['money']}}</td>
                            <td>{{$order['statusName']}}</td>
                            <td>{{$order['createTime']}}</td>
                            <td><a href="{{DOMAIN}}admin/order/{{$order['id']}}"
                                   class="am-btn am-btn-default am-btn-xs" style="padding:3px 15px;">查看</a></td>
                        </tr>
                            @endforeach
                        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="height:150px;">{{--空白--}}</div>
</div>