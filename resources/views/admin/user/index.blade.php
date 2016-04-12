@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            <div class="am-u-sm-12">
                <div class="am-form-group">
                    会员类型：
                    <select name="isuser">
                        <option value="" {{ $isuser=='' ? 'selected' : '' }}>所有会员</option>
                        @foreach($isusers as $kisuser=>$isuser)
                            <option value="{{ $kisuser }}"
                                    {{ $isuser==$kisuser ? 'selected' : '' }}>{{ $isuser }}</option>
                        @endforeach
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    是否审核：
                    <select name="isauth">
                        <option value="" {{ $isauth=='' ? 'selected' : '' }}>所有会员</option>
                        @foreach($isauths as $kisauth=>$isauth)
                            <option value="{{ $kisauth }}"
                                    {{ $isauth==$kisauth ? 'selected' : '' }}>{{ $isauth }}</option>
                        @endforeach
                    </select>
                    <script>
                        var isuser = $("select[name='isuser']");
                        var isauth = $("select[name='isauth']");
                        isuser.change(function(){
                            if(isuser.val()=='' && isauth.val()==''){
                                window.location.href = '/admin/user';
                            } else {
                                window.location.href = '/admin/'+isuser.val()+isauth.val()+'/user';
                            }
                        });
                    </script>
                </div>
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
                        <th class="table-type">每页记录数</th>
                        <th class="table-date am-hide-sm-only">创建时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if($datas->total())
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data->id }}</td>
                        <td class="am-hide-sm-only">{{ $data->username }}</td>
                        <td class="am-hide-sm-only">{{ $data->isauth() }}</td>
                        <td class="am-hide-sm-only">{{ $data->isuser() }}</td>
                        <td class="am-hide-sm-only">
                            <input type="text" style="width:50px;border:0;" readonly value="{{ $data->limit }}">
                            <a href="/admin/user/increase/{{ $data->id }}" class="increase" title="增加1">▲</a><a href="/admin/user/reduce/{{ $data->id }}" class="reduce" title="减少1">▼</a>
                        </td>
                        <td class="am-hide-sm-only">{{ $data->created_at }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="/admin/user/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/edit.png" class="icon">设置</button></a>
                                    <a href="/admin/user/toauth/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/edit.png" class="icon">通过</button></a>
                                    <a href="/admin/user/noauth/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/edit.png" class="icon">拒绝</button></a>
                                    <a href="/admin/user/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/show.png" class="icon"> 查看</button></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else @include('admin.common.norecord')
                @endif
                    </tbody>
                </table>
                @include('admin.common.page')
            </div>
        </div>
    </div>
@stop