{{-- 后台首页模板 --}}


<div class="admin-content">
    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>一些常用模块</small></div>
    </div>
    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list">
        <li><a href="{{DOMAIN}}admin/user" class="am-text-secondary">
                <span class="am-icon-btn am-icon-user-md"></span>
                <br/>一周内/在线/注册用户<br/> {{$users['week']}}/{{$users['hour']}}/{{$users['all']}}
            </a>
        </li>
        <li><a href="{{DOMAIN}}admin/order" class="am-text-warning">
                <span class="am-icon-btn am-icon-briefcase"></span>
                <br/>创作/交易/售后订单<br/> {{$orders['create']}}/{{$orders['all']}}/{{$orders['firm']}}
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
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->username }}</td>
                    <td><a href="#">{{ $data->isuser() }}</a></td>
                    <td><span class="am-badge am-badge-success">{{ $data->createTime() }}</span></td>
                    <td>
                        {{--<div class="am-btn-toolbar">--}}
                            {{--<div class="am-btn-group am-btn-group-xs">--}}
                                {{--<a href="{{DOMAIN}}admin/user/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="am-dropdown" data-am-dropdown>
                            <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                            <ul class="am-dropdown-content">
                                <li><a href="{{DOMAIN}}admin/user/{{$data->id}}">查看</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                    @endforeach
                @else @include('admin.common.norecord')
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
                            <td>发布方</td>
                            <td>价格</td>
                            <td>状态</td>
                            <td>时间</td>
                            <td>操作</td>
                        </tr>
                        <tr><td colspan="10" style="border-top:1px solid lightgrey;"></td></tr>
                        @if(count($orders['ordersC']))
                            @foreach($orders['ordersC'] as $orderC)
                            <tr>
                                <td>{{$orderC->id}}</td>
                                <td>{{$orderC->buyerName}}</td>
                                <td>{{$orderC->sellerName}}</td>
                                <td>{{$orderC->money()}}</td>
                                <td>{{$orderC->statusName()}}</td>
                                <td>{{date("Y年m月d日",$orderC->created_at)}}</td>
                                <td><a href="{{DOMAIN}}admin/orderpro/{{$orderC->id}}"
                                       class="am-btn am-btn-default am-btn-xs" style="padding:3px 15px;">查看</a></td>
                            </tr>
                            @endforeach
                        @else @include('admin.common.norecord')
                        @endif
                    </table>
                    {{--<ul class="am-list admin-content-task">--}}
                        {{--@if(count($orders['ordersC']))--}}
                            {{--@foreach($orders['ordersC'] as $orderC)--}}
                        {{--<li>--}}
                            {{--<div class="admin-task-meta"> 创建于 {{$orderC->createTime()}} 通过 {{$orderC->getBuyName()}}</div>--}}
                            {{--<div class="admin-task-bd">订单编号：{{$orderC->serial}}，&nbsp;&nbsp;发布方：{{$orderC->sellerName}}，&nbsp;&nbsp;申请方：{{$orderC->buyerName}}，&nbsp;&nbsp;价位：{{$orderC->money()}}，&nbsp;&nbsp;状态：{{$orderC->statusName}}。</div>--}}
                        {{--</li>--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--<li><p style="text-align:center;">没有记录</p></li>--}}
                        {{--@endif--}}
                    {{--</ul>--}}
                </div>
            </div>
            {{--售后订单--}}
            <div class="am-panel am-panel-default">
                <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-1'}">售后订单<span class="am-icon-chevron-down am-fr" ></span></div>
                <div class="am-panel-bd am-collapse am-in" id="collapse-panel-1">
                    <table style="width:100%;font-size:14px;">
                        <tr>
                            <td>编号</td>
                            <td>申请方</td>
                            <td>发布方</td>
                            <td>价格</td>
                            <td>状态</td>
                            <td>时间</td>
                            <td>操作</td>
                        </tr>
                        <tr><td colspan="10" style="border-top:1px solid lightgrey;"></td></tr>
                        @if(count($orders['ordersF']))
                            @foreach($orders['ordersF'] as $orderF)
                            <tr>
                                <td>{{$orderF->id}}</td>
                                <td>{{$orderF->buyerName}}</td>
                                <td>{{$orderF->sellerName}}</td>
                                <td>{{$orderF->money()}}</td>
                                <td>{{$orderF->statusName()}}</td>
                                <td>{{date("Y年m月d日",$orderF->created_at)}}</td>
                                <td><a href="{{DOMAIN}}admin/orderfirm/{{$orderF->id}}"
                                       class="am-btn am-btn-default am-btn-xs" style="padding:3px 15px;">查看</a></td>
                            </tr>
                            @endforeach
                        @else @include('admin.common.norecord')
                        @endif
                    </table>
                    {{--<ul class="am-list admin-content-task">--}}
                        {{--@if(count($orders['ordersF']))--}}
                            {{--@foreach($orders['ordersF'] as $orderF)--}}
                        {{--<li>--}}
                            {{--<div class="admin-task-meta"> 创建于 {{$orderF->createTime()}} 通过 {{$orderF->buyerName()}}</div>--}}
                            {{--<div class="admin-task-bd">订单编号：{{$orderF->serial}}，&nbsp;&nbsp;发布方：{{$orderF->sellerName}}，&nbsp;&nbsp;申请方：{{$orderF->buyerName}}，&nbsp;&nbsp;价位：{{$orderF->money()}}，&nbsp;&nbsp;状态：{{$orderF->statusName}}。</div>--}}
                        {{--</li>--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--<li><p style="text-align:center;">没有记录</p></li>--}}
                        {{--@endif--}}
                    {{--</ul>--}}
                </div>
            </div>
        </div>
        {{--横向列表--}}
        <div class="am-u-md-6">
            <div class="am-panel am-panel-default">
                <div class="am-panel-hd am-cf" data-am-collapse="{target: '#collapse-panel-2'}">交易订单<span class="am-icon-chevron-down am-fr" ></span></div>
                <div class="am-panel-bd am-collapse am-in" id="collapse-panel-2">
                    <table style="width:100%;font-size:14px;">
                        <tr>
                            <td>编号</td>
                            <td>申请方</td>
                            <td>发布方</td>
                            <td>价格</td>
                            <td>状态</td>
                            <td>时间</td>
                            <td>操作</td>
                        </tr>
                        <tr><td colspan="10" style="border-top:1px solid lightgrey;"></td></tr>
                        @if(count($orders['ordersA']))
                            @foreach($orders['ordersA'] as $orderA)
                        <tr>
                            <td>{{$orderA->id}}</td>
                            <td>{{$orderA->buyerName}}</td>
                            <td>{{$orderA->sellerName}}</td>
                            <td>{{$orderA->money()}}</td>
                            <td>{{$orderA->statusName()}}</td>
                            <td>{{date("Y年m月d日",$orderA->created_at)}}</td>
                            <td><a href="{{DOMAIN}}admin/order/{{$orderA->id}}"
                                   class="am-btn am-btn-default am-btn-xs" style="padding:3px 15px;">查看</a></td>
                        </tr>
                            @endforeach
                        @else @include('admin.common.norecord')
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="height:150px;">{{--空白--}}</div>
</div>