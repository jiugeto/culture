@extends('online.main')
@section('content')
    {{--  在线创建窗口 --}}
    <div class="online_win" style="position:relative;left:-140px;">
        <div class="frame_title">
            <span class="left" title="点击返回大厅" onclick="back()"><b>返回大厅</b></span>
            {{$product->name}}
            @if(Session::has('user') && Session::get('user.uid')==$product->uid)
                <span class="right" title="点击返回我的作品列表" onclick="myworks()"><b>我的作品</b></span>
            @endif
        </div>
        <iframe src="{{DOMAIN}}online/u/{{$product->id}}/frame/play2/{{$layerid}}/{{$con_id}}/{{$genre}}" frameborder="0" width="720" height="438" scrolling="no" allowtransparency="true"></iframe>

        {{--返回到产品预览--}}
        <a class="getpro" href="{{DOMAIN}}online/u/product/pre/{{$product->id}}" target="_blank" title="点击该作品全程预览">
            <div class="frame_title">预览该作品</div>
            <div style="height:5px;"></div>
        </a>

        {{--前台创作的内容、属性修改模板--}}
        <div class="frame_right">
            @include('online.frame.creation')
        </div>

        {{--前台创作的动画设置模板--}}
        @include('online.frame.layer')
    </div>

    <script>
        function back(){ window.location.href = '{{DOMAIN}}online'; }
        function myworks(){
            var productid = $("input[name='productid']").val();
            window.location.href = '{{DOMAIN}}online/u/product';
        }
    </script>
@stop