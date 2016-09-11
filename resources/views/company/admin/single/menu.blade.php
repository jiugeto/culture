{{--扩展模块的菜单--}}


<div class="search_type" style="height:20px;border:0;">
    <a href="/company/admin/single" class="list_btn">单页列表</a>
    <a href="/company/admin/singlemodule" class="list_btn">单页模块</a>
    <span class="create_right"><a href="/company/admin/{{$curr_func}}/create" class="list_btn">
            添加{{$curr_func=='single'?'页面':'模块'}}</a></span>
</div>