{{--这里是展示右侧信息的模板--}}

<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">
            <div class="user-info">
                {{--<p>等级信息</p>--}}
                {{--<div class="am-progress am-progress-sm">--}}
                    {{--<div class="am-progress-bar" style="width: 60%"></div>--}}
                {{--</div>--}}
                {{--<p class="user-info-order">--}}
                    {{--当前等级：<strong>LV8</strong> --}}
                    {{--活跃天数：<strong>587</strong> --}}
                    {{--距离下一级别：<strong>160</strong></p>--}}
                {{--<p>管理员信息</p>--}}
                <p class="user-info-order">管理员名称：<strong>{{ Session::get('admin.username') }}</strong></p>
                <p class="user-info-order">所在角色组：{{ Session::get('admin.role_name') }}<strong></strong></p>
                <p class="user-info-order">注册时间：<strong>{{ Session::get('admin.createTime') }}</strong></p>
                <p>登陆时间：<strong>{{ Session::get('admin.loginTime') }}</strong></p>
            </div>
            {{--<div class="user-info">--}}
                {{--<p>信用信息</p>--}}
                {{--<div class="am-progress am-progress-sm">--}}
                    {{--<div class="am-progress-bar am-progress-bar-success" style="width: 80%"></div>--}}
                {{--</div>--}}
                {{--<p class="user-info-order">--}}
                    {{--信用等级：正常当前 --}}
                    {{--信用积分：<strong>80</strong>--}}
                {{--</p>--}}
            {{--</div>--}}
        </div>
    </div>
</div>