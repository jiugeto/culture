@extends('online.main')
@section('content')
    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="frame_title">
            <span style="margin-left:10px;float:left;cursor:pointer;" onclick="back()"><b>返回</b></span>
            {{$data->uid?'我的动画':'动画大厅'}} - {{$data->name}}
        </div>
        <iframe src="{{DOMAIN}}online/pro/play/{{$data->id}}" frameborder="0" width="720" height="438" scrolling="no" allowtransparency="true"></iframe>
        <a href="{{DOMAIN}}online/u/product/getpro/{{$data->id}}" class="getpro">
            <input type="hidden" name="uid" value="{{ Session::has('user')?Session::get('user.uid'):0 }}">
            @if (!$data->uid)
            <div class="frame_title" onclick="getProduct({{$data->id}})">获 取</div>
            @else
            <div class="frame_title" onclick="editProduct({{$data->id}})">编 辑</div>
            @endif
        </a>
    </div>

    <script>
        function back(){ window.location.href = '{{DOMAIN}}online'; }
        function getProduct(id){
            var uid = $("input[name='uid']").val();
            if (uid==0) {
                alert('你还没有登录！');
                window.location.href = '{{DOMAIN}}login';
            } else {
                window.location.href = '{{DOMAIN}}online/u/product/getpro/'+id;
            }
        }
    </script>
@stop