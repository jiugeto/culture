@include('admin.proCreation.basic.editStyle')

<div style="width:720px;height:405px;background:ghostwhite;">{{--背景--}}</div>
<div id="win_out">
    <div class="attr {{$attr->style_name}}">
        <div class="pos">
            <div class="dh">
                @if($attr->genre==1)
                <img src="/uploads/images/2016/ppt.png">
                @endif
            </div>
        </div>
    </div>
</div>