@extends('home.main')
@section('content')
    <script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
    @include('home.common.crumb')
    <div style="height:2px;">{{--空白--}}</div>
    <div class="pro_content">
        @include('home.product.menu')

        <div class="pro_floor">
            <div class="title">
                定做的片源
                <a onclick="addProCus();" style="color:orangered;float:right;cursor:pointer;">添加新片源</a>
            </div>
            <div class="cre_source" style="padding:0;">
                <table class="goodCus">
                    <tr>
                        <td>片源名</td>
                        <td width="200">描述</td>
                        <td>需求方</td>
                        <td>预算</td>
                        <td>提供数</td>
                        <td>供应方</td>
                        <td>发布时间</td>
                        <td width="100">操作</td>
                    </tr>
                @if(count($datas))
                    @foreach($datas as $data)
                        <tr>
                            <td>{{ str_limit($data->name,10) }}</td>
                            <td>{{ str_limit($data->intro,20) }}
                                <input type="hidden" name="intro_{{$data->id}}" value="{{ $data->intro }}">
                                <a onclick="setIntro({{$data->id}});" style="color:orangered;">详情</a>
                            </td>
                            <td>{{ $data->getUName() }}</td>
                            <td>{{ $data->getMoney1() }}</td>
                            <td>{{ count($data->getGoodCustoms(10)) }}</td>
                            <td>{{ $data->getSupplyName() }}</td>
                            <td>{{ date('Y年m月d日',$data->created_at) }}</td>
                            <td>
                                @if((Session::has('user')&&in_array(Session::get('user.userType'),[1,2,3,7,50])))
                                <a onclick="addCus({{$data->id}});" style="color:orangered;" title="寻求合作机会">申请片源</a>
                                @else 未登录
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </table>
            </div>
            <br>
            @include('home.common.page')
        </div>
        <br style="clear:both;"><br>
    </div>
    <input type="hidden" name="curr_uid" value="{{ Session::has('user')?Session::get('user.uid'):0 }}">
    <input type="hidden" name="userVideoType" value="{{ (Session::has('user')&&in_array(Session::get('user.userType'),[4,5,6,50]))?:0 }}">

    <div class="tankuang" id="intro">
        <div class="mask"></div>
        <div class="con">
            <p class="tk_intro"></p>
            <a onclick="$('.tankuang').hide(200);">X</a>
        </div>
    </div>
    <div class="tankuang" id="addProCus">
        <div class="mask"></div>
        <div class="con">
            <form method="POST" action="{{DOMAIN}}product/addProCus" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="uid" value="{{ Session::has('user')?Session::get('user.uid'):0 }}">
                <p>片源名称：<br>
                    <input type="text" placeholder="用户需求片源的名称" minlength="2" maxlength="20" required name="name">
                </p>
                <p>片源描述：<br>
                    <textarea placeholder="效果解释说明、描述" minlength="2" required name="intro" rows="5"></textarea>
                </p>
                <p>价格预算：<br>
                    <input type="text" placeholder="片源预算，单位元" pattern="^\d+$" name="money">
                </p>
                <button type="submit" class="homebtn" style="margin:20px 150px;">立即申请</button>
            </form>
            <a onclick="$('.tankuang').hide(200);">X</a>
        </div>
    </div>
    <div class="tankuang" id="addCus">
        <div class="mask"></div>
        <div class="con">
            <form data-am-validator method="POST" action="{{DOMAIN}}product/addCus" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cus_id">
                <input type="hidden" name="supply" value="{{ Session::has('user')?Session::get('user.uid'):0 }}">
                <p>参考效果外链：<br>
                    <input type="text" placeholder="参考样片或图片外部链接：https://www.baidu.com" minlength="2" required name="link">
                </p>
                <p>效果描述：<br>
                    <textarea placeholder="效果解释说明、描述" minlength="2" required name="intro" rows="5"></textarea>
                </p>
                <p>估价(单位元)：<br>
                    <input type="text" pattern="^\d+$" required name="money">
                </p>
                <p>制作周期(单位天)：<br>
                    <input type="text" pattern="^[1-9]|([1-9]\d+)$" required name="time">
                </p>
                <button type="submit" class="homebtn" style="margin:20px 150px;">立即申请</button>
            </form>
            <a onclick="$('.tankuang').hide(200);">X</a>
        </div>
    </div>

    <script>
        var curr_uid = $("input[name='curr_uid']").val();
        //查看片源需求详情限制
        function setIntro(id){
            if (curr_uid==0) {
//                alert('还没有登录，不能查看！');
                $(".tk_intro").html("还没有登录，不能查看！");
            } else {
                var intro = $("input[name='intro_"+id+"']").val();
                $(".tk_intro").html(intro);
            }
            $("#intro").show(200);
        }
        //用户增加样片片源
        function addProCus(){
            if (curr_uid==0) {
//                $(".tk_intro").html("还没有登录，不能添加！");
//                $("#intro").show(200);
//                return;
            }
            $('#addProCus').show(200);
        }
        //供应方申请某片源合作
        function addCus(id){
            var userVideoType = $("input[name='userVideoType']").val();
            if (curr_uid==0) {
//                alert('还没有登录，不能申请！');
                $(".tk_intro").html("还没有登录，不能申请！");
                $("#intro").show(200);
                return;
            } else if (userVideoType==0) {
                $(".tk_intro").html("非设计师、广告公司、影视公司等，不能申请！");
                $("#intro").show(200);
                return;
            }
            $("input[name='cus_id']")[0].value = id;
            $('#addCus').show(200);
        }
    </script>
@stop