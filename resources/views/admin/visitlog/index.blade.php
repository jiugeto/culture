@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')

        <div class="am-u-sm-12 am-u-md-3" style="width:110px;">
            <div class="am-input-group am-input-group-sm">
                <span class="am-input-group-btn">
                    <button type="button" class="am-btn am-btn-default btnClick" id="company">企业</button>
                    <button type="button" class="am-btn am-btn-default" id="user">用户</button>
                    <input type="hidden" name="genre" value="1">
                </span>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
            <div class="am-input-group am-input-group-sm">
                <input type="text" class="am-form-field" placeholder="输入企业名称，可不填" name="uname" value="{{ $uname }}">
                <span class="am-input-group-btn">
                    <button type="button" class="am-btn am-btn-default" onclick="search($('input[name=uname]').val())">搜索</button>
                </span>
            </div>
        </div>
        <script>
            $("#company").click(function(){
                $(this).addClass('btnClick'); $("#user").removeClass('btnClick');
                $("input[name='genre']")[0].value = 1;
                $("input[name='uname']")[0].placeholder = '输入企业名称';
            });
            $("#user").click(function(){
                $(this).addClass('btnClick'); $("#company").removeClass('btnClick');
                $("input[name='genre']")[0].value = 2;
                $("input[name='uname']")[0].placeholder = '输入用户名称';
            });

            //u代表用户简写
            function search(uname){
                var genre = $("input[name='genre']").val();
                if (!uname) {
//                    alert('列出所有记录！');
                    window.location.href = '{{DOMAIN}}admin/visit';
                } else if (genre==1 && uname) {
                    window.location.href = '{{DOMAIN}}admin/visit/u/1/'+uname;
                } else if (genre==2 && uname) {
                    window.location.href = '{{DOMAIN}}admin/visit/u/2/'+uname;
                }
            }
        </script>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">用户名</th>
                        <th class="table-type">企业名称</th>
                        <th class="table-type">当天访问次数</th>
                        {{--<th class="table-type">当天访问时长</th>--}}
                        <th class="table-date am-hide-sm-only">首次访问时间</th>
                        <th class="table-date am-hide-sm-only">最后访问时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{$data['id']}}</td>
                        <td class="am-hide-sm-only">{{$data['uname']}}</td>
                        <td class="am-hide-sm-only">{{$data['cname']}}</td>
                        <td class="am-hide-sm-only">{{$data['dayCount']}}</td>
                        {{--<td class="am-hide-sm-only">{{$data->getTimeCount}}</td>--}}
                        <td class="am-hide-sm-only">{{$data['loginTimeStr']}}</td>
                        <td class="am-hide-sm-only">{{$data['logoutTimeStr']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/visit/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
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