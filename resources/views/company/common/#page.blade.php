{{--分页模板--}}


<style>
    .out { width:1000px;text-align:center;color:grey; }
    .out #ul,.out #text { margin:10px auto;width:980px; }
    .out a { padding:2px 10px;color:grey;text-decoration:none;border:1px solid grey;font-size:14px;cursor:pointer; }
    .out a:hover,.out a.curr { color:orangered;border:1px solid orangered; }
    .out input { color:grey;text-align:center;position:relative;top:-1px; }
</style>

<div class="out">
    <div id="ul">
        <a href="{{ $prefix_url }}" style="font-size:14px;">首页</a>
        <a href="{{ $prefix_url }}/?page={{ $datas->currentPage()==1?$datas->currentPage():$datas->currentPage()-1 }}">&#8249;</a>
        <a href="{{ $prefix_url }}/?page={{ $datas->currentPage() }}" class="active">{{ $datas->currentPage() }}</a>
        @if($datas->lastPage()>$datas->currentPage())
            @if(ceil($datas->total()/$datas->limit)>$datas->currentPage())
                <a href="{{ $prefix_url }}/?page={{ $datas->currentPage()+1 }}">{{ $datas->currentPage()+1 }}</a>
            @endif
            @if(ceil($datas->total()/$datas->limit)>$datas->currentPage()+1)
                <a href="{{ $prefix_url }}/?page={{ $datas->currentPage()+2 }}">{{ $datas->currentPage()+2 }}</a>
            @endif
            @if(ceil($datas->total()/$datas->limit)>$datas->currentPage()+3)
                <a href="{{ $prefix_url }}/?page={{ $datas->currentPage()+3 }}">{{ $datas->currentPage()+3 }}</a>
            @endif
        @endif
        <a href="{{ $prefix_url }}/?page={{ ($datas->lastPage()<$datas->currentPage()&&$datas->currentPage()==1)?$datas->currentPage():$datas->currentPage()+1 }}">&#8250;</a>
        <a href="{{ $prefix_url }}/?page={{ $datas->lastPage() }}" style="font-size:14px;">尾页</a>
        &nbsp;&nbsp; 跳到第 <input type="text" name="page" style="width:15px;" value="{{ $datas->currentPage() }}"> 页
        <a onclick="window.location.href='{{ $prefix_url }}/?page='+$('input[name=page]').val();">确定</a>
    </div>
    <div id="text">每页{{ $datas->limit }}{{--{{ $datas->count() }}--}}条记录，共{{ $datas->lastPage() }}页，共{{ $datas->total() }}条记录，当前是第{{ $datas->currentPage() }}页</div>
</div>