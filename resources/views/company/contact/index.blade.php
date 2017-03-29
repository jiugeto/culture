@extends('company.main')
@section('content')
    <div style="height:10px;">{{--空白--}}</div>
    {{-- <<<<<载入百度地图>>>>> --}}
    <style type="text/css">
        .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
        .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
        /*.anchorBL{display:none}     !*去除地图中百度图标*!*/
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?ak={{$ak}}&v=2.0&services=true"></script>
    <!--百度地图容器-->
    <div style="width:100%;height:550px;border:#ccc solid 1px;" id="dituContent"></div>
    <p>
        公司名称：{{$data['name']}} &nbsp;&nbsp;&nbsp;&nbsp;
        地址：{{$data['address']}} &nbsp;&nbsp;&nbsp;&nbsp;
        电话： {{$data['tel']}} &nbsp;&nbsp;&nbsp;&nbsp;
        QQ： {{$data['qq']}} &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="hidden" name="companyname" value="{{$data['name']}}">
        <input type="hidden" name="address" value="{{$data['address']}}">
        <input type="hidden" name="axis_x" value="{{$data['pointx']}}">
        <input type="hidden" name="axis_y" value="{{$data['pointy']}}">
    </p>

    <script type="text/javascript">
        var axis_x = $("input[name='axis_x']").val();
        var axis_y = $("input[name='axis_y']").val();
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
            addMarker();//向地图中添加marker
        }
        //创建地图函数：
        function createMap(){
            var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
            var point = new BMap.Point(axis_x,axis_y);//定义一个中心点坐标
            map.centerAndZoom(point,14);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }
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
        //标注点数组
        var markerArr = [{title:$("input[name='companyname']").val(),content:$("input[name='address']").val(),point:axis_x+"|"+axis_y,isOpen:0,icon:{w:21,h:21,l:-30,t:-20,x:6,lb:5}}
        ];
        //创建marker标识
        function addMarker(){
            for(var i=0;i<markerArr.length;i++){
                var json = markerArr[i];
                var p0 = json.point.split("|")[0];
                var p1 = json.point.split("|")[1];
                var point = new BMap.Point(p0,p1);
                var iconImg = createIcon(json.icon);
                var marker = new BMap.Marker(point,{icon:iconImg});
                var iw = createInfoWindow(i);
                var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
                marker.setLabel(label);
                map.addOverlay(marker);
                label.setStyle({
//                            borderColor:"#808080",
//                            color:"#333",
                    cursor:"pointer",
                    borderColor:"red",
                    color:"red",
                    fontSize:"16px",
                    fontFamily:"微软雅黑",
                    fontWeight:"bold",
                    boxShadow:"5px 5px 10px grey",
                    border:"2px solid red",
                    padding:"5px"
                });
                (function(){
                    var index = i;
                    var _iw = createInfoWindow(i);
                    var _marker = marker;
                    _marker.addEventListener("click",function(){
                        this.openInfoWindow(_iw);
                    });
                    _iw.addEventListener("open",function(){
                        _marker.getLabel().hide(188);
                    });
                    _iw.addEventListener("close",function(){
                        _marker.getLabel().show(188);
                    });
                    label.addEventListener("click",function(){
                        _marker.openInfoWindow(_iw);
                    });
                    if(json.isOpen){
                        label.hide(188);
                        _marker.openInfoWindow(_iw);
                    }
                })()
            }
        }
        //创建InfoWindow，点击图标后的内容窗口
        function createInfoWindow(i){
            var json = markerArr[i];
            var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
            return iw;
        }
        //创建一个Icon，定位的图标
        function createIcon(json){
            var thmb = '/assets-home/images/pos.png';
            var icon = new BMap.Icon(thmb, new BMap.Size(json.w*4,json.h*4),{
                imageOffset: new BMap.Size(-json.l,-json.t),
                infoWindowOffset:new BMap.Size(json.lb+5,1),
                offset:new BMap.Size(json.x,json.h)
            });
            return icon;
        }
        initMap();//创建和初始化地图
    </script>
@stop