{{--系统后台类型搜索模板--}}


<div class="am-u-sm-12 am-u-md-3">
    <div class="am-form-group">
        所属表：
        <select name="table_id" onchange="toList(this.value)" data-am-selected="{btnSize: 'sm'}">
            <option value="0" {{ $table_id==0 ? 'selected' : '' }}>所有</option>
            @foreach($tableIds as $tableId=>$tableName)
                <option value="{{ $tableId }}"
                        {{ $table_id==$tableId ? 'selected' : '' }}>
                    {{ $tableName }}</option>
            @endforeach
        </select>
        <script>
            function toList(value){
                if(value==0){
                    window.location.href = '{{DOMAIN}}admin/type';
                } else {
                    window.location.href = '{{DOMAIN}}admin/type/tableid/'+value;
                }
            }
        </script>
    </div>
</div>
<div class="am-u-sm-12 am-u-md-3">
    <div class="am-input-group am-input-group-sm">
        <input type="text" class="am-form-field">
        <span class="am-input-group-btn">
            <button class="am-btn am-btn-default" type="button">搜索</button>
        </span>
    </div>
</div>