{{-- 顶部模板 --}}


<div class="per_top">
    <p class="t"><b>{{ \Session::has('user')?\Session::get('user.username'):'' }} 的个人后台</b></p>
    <p><a href="">{{ 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] }}</a></p>
    <p class="t"><b>
            @foreach($links as $klink=>$vlink)
                <a href="{{ DOMAIN.'person/'.$klink }}" class="{{ $curr==$klink ? 'curr_link' : '' }}">{{ $vlink }}</a> &nbsp;
            @endforeach
        </b></p>
</div>