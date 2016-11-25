{{-- 租赁搜索模板 --}}


<div class="search_type">
    供求类别
    <select name="genre">
        <option value="0" {{ $genre==0 ? 'selected' : '' }}>所有类别</option>
        <option value="1" {{ $genre==1 ? 'selected' : '' }}>需求</option>
        <option value="2" {{ $genre==2 ? 'selected' : '' }}>供应</option>
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;
    设备
    <select name="genre">
        <option value="0" {{ $type==0 ? 'selected' : '' }}>所有类别</option>
        @foreach($model['types'] as $ktype=>$vtype)
        <option value="{{$ktype}}" {{ $type==$ktype ? 'selected' : '' }}>{{$vtype}}</option>
        @endforeach
    </select>
</div>

<script>
    $(document).ready(function(){
        var genre = $("select[name='genre']");
        genre.change(function(){
//            alert(genre.val());
            if(genre.val()!=0){
                window.location.href = '{{DOMAIN}}member/'+genre.val()+'/rent';
            } else {
                window.location.href = '{{DOMAIN}}member/rent';
            }
        });
    });
</script>