@extends('online.main')
@section('content')
    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="frame_title">
            <span class="left" onclick="back()"><b>返回大厅</b></span>
            {{--{{$data->uid?'我的动画':'动画大厅'}} - --}}{{$data->name}}
            @if(Session::has('user') && Session::get('user.uid')==$data->uid)
            <span class="right" onclick="myworks()"><b>我的作品</b></span>
            @endif
        </div>
        <iframe src="{{DOMAIN}}online/pro/play/{{$data->id}}" frameborder="0" width="720" height="438" scrolling="no" allowtransparency="true"></iframe>

        <a class="getpro">
            @if (!$data->uid)
            <div class="frame_title" onclick="getProduct({{$data->id}})">获 取</div>
            @else
            <div class="frame_title" onclick="editProduct({{$data->id}})">编 辑</div>
            @endif
        </a>

        <div class="render">
            <div class="title">渲染设置</div>
            <div class="con">
                输出格式：
                <select name=""></select>
            </div>
        </div>
    </div>
    <input type="hidden" name="uid" value="{{ Session::has('user')?Session::get('user.uid'):0 }}">
    <input type="hidden" name="productid" value="{{$data->id}}">

    <script>
        function back(){ window.location.href = '{{DOMAIN}}online'; }
        function myworks(){
            var productid = $("input[name='productid']").val();
            window.location.href = '{{DOMAIN}}online/u/product';
        }
        function getProduct(id){
            var uid = $("input[name='uid']").val();
            if (uid==0) {
                alert('你还没有登录！');
                window.location.href = '{{DOMAIN}}login';
            } else {
                window.location.href = '{{DOMAIN}}online/u/product/getpro/'+id;
            }
        }
        function editProduct(id){ window.location.href = '{{DOMAIN}}online/u/'+id+'/frame'; }
    </script>
@stop