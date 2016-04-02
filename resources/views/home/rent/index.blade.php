@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            租赁供求：
            <select name="genre">
                <option value="0" {{ $genre==0 ? 'selected' : '' }}>-请选择-</option>
                <option value="1" {{ $genre==1 ? 'selected' : '' }}>设备供应</option>
                <option value="2" {{ $genre==2 ? 'selected' : '' }}>设备需求</option>
            </select>
            <script>
                $(document).ready(function(){
                    var genre = $("select[name='genre']");
                    genre.change(function(){
                        if(genre.val()==0){
                            window.location.href = '/rent';
                        } else {
                            //SD就是SupplyDemand
                            window.location.href = '/rent/SD/'+genre.val();
                        }
                    });
                });
            </script>
        </div>

        {{-- 列表 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_list">
            <table class="record">
                <tr>
                    <td rowspan="2" class="td_r_img">
                        <div class="r_img"><img src="/upload/images/online1.png"></div>
                    </td>
                    <td>设备名称：</td>
                    <td>供求关系：</td>
                </tr>
                <tr>
                    <td>租赁公司：</td>
                    <td>地区：</td>
                    <td>公司地址：</td>
                </tr>
            </table>
        </div>
        <div class="s_right">
            <div class="cate"></div>
            <img src="/upload/images/ppt.png">
        </div>
    </div>

    <script>
        $(document).ready(function(){
            //根据浏览器宽度设置菜单位置
            var clientWidth = document.body.clientWidth;
            var s_right = $(".s_right");
            s_right.css('position','absolute');
            s_right.css('top',225+'px');
            s_right.css('right',(clientWidth-1000)/2+10+'px');
        });
    </script>
@stop