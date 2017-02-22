@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            <select name="isshow" style="padding:2px 10px;border:1px solid lightgrey;">
                <option value="0" {{ $isshow==0?'selected':'' }}>所有</option>
                <option value="1" {{ $isshow==1?'selected':'' }}>不显示</option>
                <option value="2" {{ $isshow==2?'selected':'' }}>显示</option>
            </select>
            <select name="pid" style="padding:2px 10px;border:1px solid lightgrey;">
                @foreach($parents as $parent)
                    <option value="{{ $parent['id'] }}" {{ $pid==$parent['pid']?'selected':'' }}>
                        {{ $parent['name'] }}</option>
                @endforeach
            </select>
            <script>
                $("select[name='isshow']").change(function(){
                    var isshow = $("select[name='isshow']").val();
                    var pid = $("select[name='pid']").val();
                    if (isshow==0 && pid==0) {
                        window.location.href = '{{DOMAIN}}admin/action';
                    } else {
                        window.location.href = '{{DOMAIN}}admin/action/s/'+isshow+'/'+pid;
                    }
                });
                $("select[name='pid']").change(function(){
                    var isshow = $("select[name='isshow']").val();
                    var pid = $("select[name='pid']").val();
                    if (isshow==0 && pid==0) {
                        window.location.href = '{{DOMAIN}}admin/action';
                    } else {
                        window.location.href = '{{DOMAIN}}admin/action/s/'+isshow+'/'+pid;
                    }
                });
            </script>
        </div>

        <div class="am-g" id="list">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title" width="80">操作名称</th>
                        <th class="table-type">控制器名称</th>
                        <th class="table-type">操作方法</th>
                        <th class="table-type">父操作</th>
                        <th class="table-author am-hide-sm-only" width="100">排序</th>
                        <th class="table-date am-hide-sm-only">是否显示</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                        <th class="table-set" width="300">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data['id'] }}</td>
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/action/{{$data['id']}}">{{ $data['name'] }}</a></td>
                        <td class="am-hide-sm-only">{{ $data['controller_prefix'].'Controller' }}</td>
                        <td class="am-hide-sm-only">{{ $data['action'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['parentName'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['sort'] }}
                            <a href="{{DOMAIN}}admin/action/increase/{{ $data['id'] }}" class="increase" title="增加1">▲</a>
                            <a href="{{DOMAIN}}admin/action/reduce/{{ $data['id'] }}" class="reduce" title="减少1">▼</a>
                        </td>
                        <td class="am-hide-sm-only">{{ $data['isShow'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['createTime'] }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    @if($data['pid']==0)
                                    <a href="{{DOMAIN}}admin/action/create/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/add.png" class="icon"> 新增子操作</button></a>
                                    @endif
                                    <a href="{{DOMAIN}}admin/action/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/action/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                        <div style="height:5px"></div>
                                    <a href="{{DOMAIN}}admin/action/{{$data['id']}}/destroy"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 删除</button></a>
                                    @if($data['isshow']==2)
                                    <a href="{{DOMAIN}}admin/action/isshow/{{$data['id']}}/{{$pid}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去隐藏</button></a>
                                    @elseif($data['isshow']==1)
                                    <a href="{{DOMAIN}}admin/action/isshow/{{$data['id']}}/{{$pid}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去显示</button></a>
                                    @endif
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