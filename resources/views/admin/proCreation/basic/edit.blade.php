@include('admin.proCreation.basic.editStyle')

<div style="width:720px;height:405px;background:ghostwhite;">{{--背景--}}</div>
<div id="win_out">
    @if(count($cons))
        @foreach($cons as $con)
    <div class="attr {{$attr->style_name}}">
        <div class="pos">
            <div class="dh">
            @if($con->genre==1)
                <img src="{{ $con->getPicUrl() }}">
            @else
                {{ $con->name }}
            @endif
            </div>
        </div>
    </div>
        @endforeach
    @endif
</div>