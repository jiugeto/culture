{{-- 话题菜单模板 --}}


<div class="am-btn-group am-btn-group-xs">
    <a href="{{DOMAIN}}admin/{{$crumb['category']['url']}}/create">
        <button type="button" class="am-btn am-btn-default">
            <img src="{{PUB}}assets/images/add.png" class="icon"> 添加{{$crumb['category']['name']}}
        </button>
    </a>
    <a href="{{DOMAIN}}admin/topic">
        <button type="button" class="am-btn am-btn-default">
            <img src="{{PUB}}assets/images/files.png" class="icon"> 专栏列表
        </button>
    </a>
    <a href="{{DOMAIN}}admin/cate">
        <button type="button" class="am-btn am-btn-default">
            <img src="{{PUB}}assets/images/files.png" class="icon"> 类别列表
        </button>
    </a>
    <a href="{{DOMAIN}}admin/talk">
        <button type="button" class="am-btn am-btn-default">
            <img src="{{PUB}}assets/images/files.png" class="icon"> 话题列表
        </button>
    </a>
</div>