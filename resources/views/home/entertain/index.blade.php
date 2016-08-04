@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <div class="s_con">
        {{-- 搜索 --}}
        <div class="cre_kong">&nbsp;{{--10px高度留空--}}</div>
        <div class="s_search">
            搜索方式：
            <label><input type="radio" name="genre0" value="1" {{ $genre0==1 ? 'checked' : '' }} onclick="window.location.href='{{DOMAIN}}entertain';">公司</label>
            <label><input type="radio" name="genre0" value="2" {{ $genre0==2 ? 'checked' : '' }} onclick="window.location.href='{{DOMAIN}}entertain/2/0';">人员</label>
            <input type="hidden" name="genre_0" value="{{ $genre0 }}">
            @if($genre0==2)
            &nbsp;&nbsp;&nbsp;&nbsp;
            娱乐类型：
            <select class="{{--s_select--}}home_search" name="genre">
                <option value="0" {{ $genre==0 ? 'selected'  : '' }}>所有</option>
                @foreach($staffModel['genres'] as $kgenre=>$vgenre)
                    <option value="{{ $kgenre }}" {{ $genre==$kgenre ? 'selected'  : '' }}>{{ $vgenre }}</option>
                @endforeach
            </select>
            <script>
                $(document).ready(function(){
                    var genre0 = $("input[name='genre_0']").val();
                    $("select[name='genre']").change(function(){
                        if (genre0==1) {
                            window.location.href = '{{DOMAIN}}entertain';
                        } else if (genre0==2) {
                            window.location.href = '{{DOMAIN}}entertain/2/'+$(this).val();
                        }
                    });
                });
            </script>
            @endif
        </div>

        {{-- 列表 --}}
        <div class="e_list">
            <table class="record">
                @if(count($datas))
                    @if($genre0==1)
                    {{--公司列表--}}
                    @foreach($datas as $data)
                <tr>
                    <td><div style="color:lightgrey;text-align:center;">{{ date('Y',$data->created_at) }}
                            <div style="border-bottom:1px solid lightgrey;"></div>{{ date('m',$data->created_at) }}
                            {{--<div style="border-bottom:1px solid lightgrey;"></div>{{ date('d',$data->created_at) }}--}}
                        </div>
                    </td>
                    <td>
                        <div class="img">
                            {{--<img src="/uploads/images/2016/online1.png">--}}
                            @if(count($data->getPics()))
                                <img src="{{ $pic[0]->getPicUrl() }}">
                            @else
                                <div style="width:280px;height:500px;background:rgb(250,250,250);"></div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="title"><b>标题：{{ $data->title }}</b></div>
                        <div class="con"><textarea id="" cols="40" rows="2" readonly style="border:0;resize:none;overflow:hidden;">{{ str_limit($data->content,40) }}</textarea></div>
                    </td>
                    <td>
                        <div class="comName">公司：{{ $data->getCompanyName() }}</div>
                        <p><a href="" class="toshow">详情</a></p>
                    </td>
                </tr>
                <tr><td colspan="10"><div style="height:10px;border-top:1px dashed lightgrey;">&nbsp;</div></td></tr>
                    @endforeach
                    @elseif($genre0==2)
                    {{--人员--}}
                    @foreach($datas as $data)
                <tr>
                    <td>
                        <div style="color:lightgrey;text-align:center;">{{ date('Y',$data->created_at) }}
                            <div style="border-bottom:1px solid lightgrey;"></div>{{ date('m',$data->created_at) }}
                            {{--<div style="border-bottom:1px solid lightgrey;"></div>{{ date('d',$data->created_at) }}--}}
                        </div>
                    </td>
                    <td>
                        <div class="img">
                            @if(count($data->getPics()))
                                <img src="{{ $pic[0]->getPicUrl() }}">
                            @else
                                <div style="width:280px;height:500px;background:rgb(250,250,250);"></div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="title"><b>艺名：{{ $data->name }}</b></div>
                        <div class="con"><textarea id="" cols="40" rows="2" readonly style="border:0;resize:none;">{{ str_limit($data->content,40) }}</textarea></div>
                    </td>
                    <td>
                        <div class="comName">公司：{{ $data->getCompanyName() }}</div>
                        <p><a href="" class="toshow">详情</a></p>
                    </td>
                </tr>
                    @endforeach
                    @endif
                @else @include('home.common.norecord')
                @endif
            </table>
        </div>
        <div class="e_right">
            {{--<img src="/uploads/images/2016/ppt.png">--}}
            <div style="width:280px;height:500px;background:rgb(250,250,250);"></div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            //根据浏览器宽度设置菜单位置
            var clientWidth = document.body.clientWidth;
            var s_right = $(".s_right");
            var e_right = $(".e_right");
            s_right.css('position','absolute');
            s_right.css('top',235+'px');
            s_right.css('right',(clientWidth-1000)/2+10+'px');
            e_right.css('position','absolute');
            e_right.css('top',235+'px');
            e_right.css('right',(clientWidth-1000)/2+10+'px');
        });
    </script>
@stop