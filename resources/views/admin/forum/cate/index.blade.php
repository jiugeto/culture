@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g" style="margin:0 20px;">
            @include('admin.forum.menu')
            <span style="margin-right:40px;color:grey;float:right;">
            专栏：
            <select name="topic" style="padding:5px 15px;border:1px solid #cccccc;"
                    onchange="getTopic(this.value)">
                <option value="0" {{$topic==0?'selected':''}}>所有</option>
                @if(count($topics))
                    @foreach($topics as $vtopic)
                        <option value="{{$vtopic['id']}}"
                                {{$topic==$vtopic['id']?'selected':''}}>
                            {{$vtopic['name']}}</option>
                    @endforeach
                @endif
            </select>
        </span>
            <script>
                function getTopic(topic){
                    if (topic==0) {
                        window.location.href = '{{DOMAIN}}admin/cate';
                    } else {
                        window.location.href = '{{DOMAIN}}admin/cate/s/'+topic;
                    }
                }
            </script>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">类别名称</th>
                        <th class="table-type">所属专栏</th>
                        <th class="table-type">父id</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{$data['id']}}</td>
                        <td class="am-hide-sm-only">
                            <a href="{{DOMAIN}}admin/theme/{{$data['id']}}">
                                {{$data['name']}}</a></td>
                        <td class="am-hide-sm-only">{{$data['topicName']}}</td>
                        <td class="am-hide-sm-only">{{$data['pname']}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/cate/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/cate/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
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