@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        <ul>
            <a href="{{DOMAIN}}member/proCus"><li>片源列表</li></a>
            <li>|</li>
        </ul>
        <div class="mem_create"><a href="javascript:;" onclick="getAdd()">添加片源</a></div>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>片源名称</td>
                <td>预算</td>
                <td>状态</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['money'] }}</td>
                <td>{{ $data['statusName'] }}</td>
                <td>{{ $data['createTime'] }}</td>
                <td>
                    <a href="{{DOMAIN}}member/goodscus/{{ $data['id'] }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/goodscus/{{ $data['id'] }}/edit" class="list_btn">修改</a>
                    <a href="{{DOMAIN}}member/goodscus/cuslist/{{ $data['id'] }}" class="list_btn">竞价列表</a>
                </td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>

    <div class="tankuang" id="add">
        <div class="mask"></div>
        <div class="con">
            <form action="{{DOMAIN}}member/goodscus" method="POST" data-am-validator enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <p style="text-align:center;">添加新片源</p>
                <p>片源名称：
                    <input type="text" name="name" placeholder="" minlength="2" maxlength="20" required>
                </p>
                <p>效果说明：
                    <textarea cols="30" rows="5" name="intro" required minlength="2" maxlength="1000" style="resize:none;"></textarea>
                </p>
                <p>预算(元)：
                    <input type="text" name="money" placeholder="样片制作预算" pattern="^\d+$" required>
                </p>
                <button type="submit" class="homebtn">立即更新</button>
            </form>
            <a title="关闭" onclick="getClose()">X</a>
        </div>
    </div>

    <script>
        function getAdd(){ $("#add").show(200); }
        function getClose(){ $(".tankuang").hide(200); }
    </script>
@stop