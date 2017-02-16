{{-- 租赁搜索模板 --}}


<div class="search_type">
    设备
    <select name="type">
        <option value="0" {{ $type==0 ? 'selected' : '' }}>所有</option>
        @foreach($model['types'] as $ktype=>$vtype)
        <option value="{{$ktype}}" {{ $type==$ktype ? 'selected' : '' }}>{{$vtype}}</option>
        @endforeach
    </select>
</div>

<script>
    $(document).ready(function(){
        var type = $("select[name='type']");
        type.change(function(){
            if(type.val()!=0){
                window.location.href = '{{DOMAIN}}member/rent/s/'+type.val();
            } else {
                window.location.href = '{{DOMAIN}}member/rent';
            }
        });
    });
</script>