{{-- 企业信息管理的分类与按钮模板 --}}


<div class="search_type">
    分类：
    <select name="type">
        <option value="0" {{ $type==0 ? 'selected' : '' }}>所有</option>
        <option value="2" {{ $type==2 ? 'selected' : '' }}>荣誉资质</option>
        <option value="3" {{ $type==3 ? 'selected' : '' }}>历程</option>
        <option value="4" {{ $type==4 ? 'selected' : '' }}>公司新闻</option>
        <option value="5" {{ $type==5 ? 'selected' : '' }}>行业资讯</option>
        <option value="6" {{ $type==6 ? 'selected' : '' }}>团队</option>
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;
    {{--@if($curr['url']!='trash')--}}
        {{--<span class="create_right">--}}
            {{--@if($type) <a href="/company/admin/info/create" class="list_btn">{{ $types[$type] }}发布</a>--}}
            {{--@else--}}
                {{--<select name="type1">--}}
                    {{--<option value="2">荣誉资质</option>--}}
                    {{--<option value="3">历程</option>--}}
                    {{--<option value="4">公司新闻</option>--}}
                    {{--<option value="5">行业资讯</option>--}}
                    {{--<option value="6">团队</option>--}}
                {{--</select>--}}
                {{--<a href="/company/admin/info/create/2" class="list_btn type1_a">发布</a>--}}
            {{--@endif--}}
        {{--</span>--}}
    {{--@endif--}}
</div>

<script>
    $(document).ready(function(){
        var type = $("select[name='type']");
        var type1 = $("select[name='type1']");
        var type1_a = $(".type1_a");
        type.change(function(){
            if(type.val()!=0){
                window.location.href = '/company/admin/'+type.val()+'/info';
            }else{
                window.location.href = '/company/admin/info';
            }
        });
        type1.change(function(){ type1_a[0].href = '/company/admin/info/create/'+type1.val(); });
    });
</script>