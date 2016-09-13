@extends('company.admin.main')
@section('content')
    <div class="com_admin_crumb">
        <p>首页 / 内容设置 / 联系编辑 / 地图坐标</p>
    </div>

    <div class="com_admin_list">
        <h3 class="center pos">公司地址坐标</h3>
        {{--<a href="http://www.gzhatu.com/dingwei.html">经纬度定位查询工具(多试些数字，更精确定位)</a>--}}
        {{--<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html">此为获取坐标定位的API</a>--}}
        <style>
            #map { margin:0 20px;width:70%;height:500px;border:1px solid lightgrey;float:left; }
            .text { width:200px;float:left; }
            p.small { color:red;font-size:14px; }
            a.a_link { padding:5px 20px;border:1px solid lightgrey;background:gainsboro;cursor:pointer; }
            a.a_link:hover { border:1px solid orangered;color:white;background:orangered; }
            #msg { color:grey;font-size:14px; }
        </style>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak={{$ak}}"></script>

        <div id="map"></div>
        <div class="text">
            <p>{{ $data->name }}</p>
            <p><label>重新精准定位地址</label>
                <br>地区：{{ $data->getAreaName($data->area) }}
                <br>地址：{{ $data->address }}
            </p>
            <p class="small">=>用法：在地图上找到您确定的位置单击，然后点击“确定”按钮即可 <br>建议地图放到最大再确定，更加精确</p>
            <p><a id="submit" class="a_link">确定</a>
                <a class="a_link" onclick="window.location.href='{{DOMAIN}}company/admin/contact';">返回</a>
            </p>

            <script>
                $(document).ready(function(){
                    var id = $("input[name='id']").val();
                    var jing_du = $("#jing_du");
                    var wei_du = $("#wei_du");
                    $("#submit").click(function(){
                        window.location.href = '{{DOMAIN}}company/admin/contact/map/'+jing_du.html()+'/'+wei_du.html();
                    });
                });
            </script>

            {{--经纬度显示--}}
            <div id="msg">
                <div style="height:50px;"></div>
                当前选择的经纬度<br>
                经度 <span id="jing_du"></span><br>
                纬度 <span id="wei_du"></span>
            </div>

            <input type="hidden" name="id" value="{{ $data->id }}">
            <input type="hidden" name="name" value="{{ $data->name }}">
            <input type="hidden" name="tel" value="{{ $data->tel }}">
            <input type="hidden" name="email" value="{{ $data->email }}">
            <input type="hidden" name="area" value="{{ $data->area }}">
            <input type="hidden" name="axis_x" value="{{ $pointer['lng'] }}">
            <input type="hidden" name="axis_y" value="{{ $pointer['lat'] }}">
        </div>
    </div>

    <script type="text/javascript">
        var name = $("input[name='name']").val();
        var tel = $("input[name='tel']").val();
        var email = $("input[name='email']").val();
        var area = $("input[name='area']").val();
        var axis_x = $("input[name='axis_x']").val();
        var axis_y = $("input[name='axis_y']").val();
        // 百度地图API功能
        var map = new BMap.Map("map");
        map.centerAndZoom(area,10);

        var point = new BMap.Point(axis_x,axis_y);
        map.centerAndZoom(point, 15);

        var marker = new BMap.Marker(point);  // 创建标注
        map.addOverlay(marker);               // 将标注添加到地图中
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画

        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }
        //地图控件添加函数：
        function addMapControl(){
            //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
            map.addControl(ctrl_nav);
            //向地图中添加缩略图控件
            var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
            map.addControl(ctrl_ove);
            //向地图中添加比例尺控件
            var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
            map.addControl(ctrl_sca);
        }
        setMapEvent();
        addMapControl();

        //单击获取点击的经纬度
        map.addEventListener("click",function(e){
            var jing_du_value = e.point.lng ;
            var wei_du_value =  e.point.lat;
            //alert(e.point.lng + "," + e.point.lat);
            var jing_du = document.getElementById("jing_du");
            var wei_du = document.getElementById("wei_du");
            jing_du.innerHTML= jing_du_value;
            wei_du.innerHTML= wei_du_value;
        });


        //提升框
        var opts = {
            width : 400,     // 信息窗口宽度
            height: 100,     // 信息窗口高度
            title : name , // 信息窗口标题
            enableMessage:true,//设置允许信息窗发送短息
            message: email
        }
        var infoWindow = new BMap.InfoWindow(tel, opts);  // 创建信息窗口对象
        marker.addEventListener("click", function(){
            map.openInfoWindow(infoWindow,point); //开启信息窗口
        });

        // 百度地图API功能
        map.centerAndZoom(point,14);
        setTimeout(function(){
            map.setZoom(18);
        }, 0);  //0秒后放大到14级
        map.enableScrollWheelZoom(true);
    </script>
@stop