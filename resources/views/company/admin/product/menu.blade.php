{{--样片菜单模板--}}


<div class="search_type">
    分类：
    <select name="cate">
        <option value="0" {{$cate==0?'selected':''}}>所有</option>
        @foreach($model['cates'] as $k=>$vcate)
            <option value="{{$k}}" {{$cate==$k?'selected':''}}>{{$vcate}}</option>
        @endforeach
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;
    {{--<a href="/company/admin/product" class="list_btn">产品列表</a>--}}
    {{--<a href="/company/admin/product/trash" class="list_btn">回收站</a>--}}
    @if($curr['url']!='trash')
        <span class="create_right"><a href="{{DOMAIN}}company/admin/{{$lists['func']['url']}}/create" class="list_btn">
                发布{{$lists['func']['url']=='product'?'产品':'花絮'}}</a></span>
        <input type="hidden" name="func_url" value="{{$lists['func']['url']}}">
    @endif
</div>

<script>
    $("select[name='cate']").change(function(){
        var func_url = $("input[name='func_url']").val();
        if ($(this).val()==0) {
            window.location.href = '{{DOMAIN}}company/admin/'+func_url;
        } else {
            window.location.href = '{{DOMAIN}}company/admin/'+func_url+'/s/'+$(this).val();
        }
    });
</script>