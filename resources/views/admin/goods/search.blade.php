{{--系统后台类型搜索模板--}}


{{--<div class="am-u-sm-12 am-u-md-3">--}}
    <div class="am-form-group" style="margin:0 30px;">
        发布单位类型：
        <select name="type" style="width:200px;height:35px;border:1px solid lightgrey;border-radius:5px;">
            <option value="0" {{ $type==0 ? 'selected' : '' }}>所有</option>
            @foreach($types as $ktype=>$vtype)
                <option value="{{ $ktype }}"
                        {{ $type=$ktype ? 'selected' : '' }}>{{ $vtype }}</option>
            @endforeach
        </select>
        <script>
            $(document).ready(function(){
                $("select[name='type']").change(function(){
                    if(this.value==0){
                        window.location.href = '/admin/goods';
                    }
                    if(this.value!=0){
                        window.location.href = '/admin/'+this.value+'/goods';
                    }
                });
            });
        </script>
    </div>
{{--</div>--}}
{{--<div class="am-u-sm-12 am-u-md-3">--}}
    {{--<div class="am-input-group am-input-group-sm">--}}
        {{--<input type="text" class="am-form-field">--}}
        {{--<span class="am-input-group-btn">--}}
            {{--<button class="am-btn am-btn-default" type="button">搜索</button>--}}
        {{--</span>--}}
    {{--</div>--}}
{{--</div>--}}