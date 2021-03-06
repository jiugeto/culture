@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        {{--<a href="{{DOMAIN}}admin/user/create">--}}
                            {{--<button type="button" class="am-btn am-btn-default">--}}
                                {{--<img src="{{PUB}}assets/images/add.png" class="icon"> 添加--}}
                            {{--</button>--}}
                        {{--</a>--}}
                        <a href="{{DOMAIN}}admin/user">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 所有
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/user/s/1/0">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 未审核
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/user/s/2/0">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 审核失败
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/user/s/3/0">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 审核成功
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="am-form-group" style="">
                {{--会员类型：--}}
                <select name="isuser" style="margin-right:10px;padding:2px 10px;border:1px solid lightgrey;float:right;">
                    <option value="0" {{ $isuser==0 ? 'selected' : '' }}>所有会员</option>
                    @foreach($isusers as $kisuser=>$isuser)
                        <option value="{{ $kisuser }}"
                                {{ $isuser==$kisuser ? 'selected' : '' }}>{{ $isuser }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="isauth" value="{{ $isauth }}">
                <script>
                    var isauth = $("input[name='isauth']").val();
                    var isuser = $("select[name='isuser']");
                    isuser.change(function(){
                        window.location.href = '{{DOMAIN}}admin/user/s/'+isauth+'/'+isuser.val();
                    });
                </script>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">会员名称</th>
                        <th class="table-type">是否认证</th>
                        <th class="table-type">是否会员</th>
                        <th class="table-date am-hide-sm-only">创建时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data['id'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['username'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['authType'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['userType'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['createTime'] }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="/admin/user/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/tool.png" class="icon">编辑</button></a>
                                    <a href="/admin/user/head/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/tool.png" class="icon"> 设置头像</button></a>
                                    @if($data['isauth']==1)
                                    <a href="/admin/user/toauth/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only" style="font-size:14px;">☑ 通过</button></a>
                                    <a href="/admin/user/noauth/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" style="font-size:14px;">☒ 拒绝</button></a>
                                    @endif
                                    <a href="/admin/user/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/show.png" class="icon"> 查看</button></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                @endif
                    </tbody>
                </table>
                @include('admin.common.page2')
            </div>
        </div>
    </div>
@stop