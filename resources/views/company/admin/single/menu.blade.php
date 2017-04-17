{{--扩展模块的菜单--}}


<div class="search_type" style="height:20px;border:0;">
    <a href="{{DOMAIN_C_BACK}}singlemodule" class="list_btn">单页模块 {{$curr_func!='single'?'✔':''}}</a> &nbsp;
    <a href="{{DOMAIN_C_BACK}}single" class="list_btn">单页功能 {{$curr_func=='single'?'✔':''}}</a>
    <span class="create_right"><a href="{{DOMAIN_C_BACK.$curr_func}}/create" class="list_btn">
            添加{{$curr_func=='single'?'功能':'模块'}}</a></span>
</div>