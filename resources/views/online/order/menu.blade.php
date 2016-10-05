{{--创作订单列表菜单模板--}}


<div class="condition">
    <div class="attr" style="text-align:right">
        <a href="{{DOMAIN}}online"><b>返回</b></a>
        <a href="{{DOMAIN}}online/u/order" style="color:{{isset(explode('/',$_SERVER['REQUEST_URI'])[4])?'grey':'orangered'}};"><b>渲染列表</b></a>
        <a href="{{DOMAIN}}online/u/order/finish" style="color:{{isset(explode('/',$_SERVER['REQUEST_URI'])[4])?'orangered':'grey'}};"><b>我的成品</b></a>
    </div>
    {{--<div class="attr">已完成：</div>--}}
</div>