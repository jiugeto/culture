<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiOnline\ApiOrderPro;
use App\Api\ApiUser\ApiGold;
use App\Tools;
use Illuminate\Http\Request;

class OrderCreController extends BaseController
{
    /**
     * 系统后台 创作订单
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '创作订单列表';
        $this->crumb['category']['name'] = '创作订单';
        $this->crumb['category']['url'] = 'ordercre';
    }

    public function index($isshow=0,$status=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/ordercre';
        $apiOrderPro = ApiOrderPro::index($this->limit,$pageCurr,0,0,$isshow,$status);
        if ($apiOrderPro['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiOrderPro['data']; $total = $apiOrderPro['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'model' => $this->getModel(),
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
            'isshow' => $isshow,
            'status' => $status,
        ];
        return view('admin.ordercre.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rst = ApiOrderPro::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ordercre.show', $result);
    }

    /**
     * 编辑视频
     */
    public function edit($id)
    {
        $curr['name'] = '视频处理';
        $curr['url'] = $this->crumb['edit']['url'];
        $rst = ApiOrderPro::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ordercre.edit', $result);
    }

    public function update(Request $request,$id)
    {
//        $videoModel = $this->insertVideo($request,$id);
        //linkType：1Flash代码，2html代码，3通用代码，4其他网址链接
        $linkType = $request->linkType;
        $link = $request->link;
        if ($linkType==1 && mb_substr($link,mb_strlen($link)-4,4)!='.swf') {
            echo "<script>alert('Flash代码的格式有误！');history.go(-1);</script>";exit;
        } elseif ($linkType==2 && mb_substr($link,0,6)!='<embed') {
            echo "<script>alert('html代码的格式有误！');history.go(-1);</script>";exit;
        } elseif ($linkType==3 && mb_substr($link,0,7)!='<iframe') {
            echo "<script>alert('通用代码的格式有误！');history.go(-1);</script>";exit;
        } elseif ($linkType==4 && mb_substr($link,0,4)!='http') {
            echo "<script>alert('其他网址链接的格式有误！');history.go(-1);</script>";exit;
        }
        //处理缩略图
        $rst = ApiOrderPro::show($id);
        $model = $rst['code']==0 ? $rst['data'] : [];
        $rstThumb = Tools::getAddrByUploadImg($request,$this->uploadSizeLimit);
        if (!$rstThumb) {
            $thumb = ($model&&$model['thumb'])?$model['thumb']:'';
        } else {
            $thumb = $rstThumb;
            if ($model['thumb']) {
                unlink(ltrim($model['thumb'],'/'));
            }
        }
        $data = [
            'thumb'=> $thumb,
            'linkType'=> $request->linkType,
            'link'=> $request->link,
        ];
//        OrderProductModel::where('id',$id)->update($data);
        $rstOrderPro = ApiOrderPro::modifyLink($data);
        if (!$rstOrderPro['code']!=0) {
            echo "<script>alert('".$rstOrderPro['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/ordercre');
    }

//    public function insertVideo(Request $request,$id)
//    {
//        if (!$request->pic_id || !$request->link) {
//            echo "<script>alert('图片、视频信息必填选！');history.go(-1);</script>";exit;
//        }
//        if (!strstr($request->link,'?') || !strstr($request->link,'&')) {
//            echo "<script>alert('视频信息格式不对！');history.go(-1);</script>";exit;
//        }
//        $links = explode('?',$request->link);
//        $orderProModel = OrderProductModel::find($id);
//        $time = time();
//        $data = [
//            'uid'=> $orderProModel->uid,
//            'name'=> $orderProModel->getProductName(),
//            'url'=> $links[0],
//            'url2'=> $links[1],
//            'pic_id'=> $request->pic_id,
//            'created_at'=> $time,
//        ];
//        VideoModel::create($data);
//        $videoModel = VideoModel::where($data)->first();
//        return $videoModel;
//    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        if (!$id || !in_array($isshow,[1,2])) {
            echo "<script>alert('参数有误！');history.go(-1);</script>";exit;
        }
        $rst = ApiOrderPro::setIsShow($id,$isshow);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/ordercre');
    }

    /**
     * 设置状态
     */
    public function setStatus($id,$status)
    {
        $rst = ApiOrderPro::setStatus($id,$status);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        //假如状态好评，则返利
        if ($status==7) {
            $rstOrderPro = ApiOrderPro::show($id);
            $uid = $rstOrderPro['code']==0 ? $rstOrderPro['data']['uid'] : 0;
        }
        if ($status==7 && isset($uid) && $uid) {
            $rstGold = ApiGold::add($uid,4);
            if ($rstGold['code']!=0) {
                echo "<script>alert('".$rstGold['msg']."');history.go(-1);</script>";exit;
            }
        }
        return redirect(DOMAIN.'admin/ordercre');
    }

    /**
     * 清空表
     */
    public function clearTable()
    {
        if (env('APP_ENV')!='local' || env('APP_DEBUG')!='true' || \Session::get('admin.username')!='jiuge') {
            echo "<script>alert('没有权限！');history.go(-1);</script>";exit;
        }
        $rst = ApiOrderPro::clearTable(\Session::get('admin.username'));
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/ordercre');
    }








    public function getModel()
    {
        $rst = ApiOrderPro::getModel();
        return $rst['code']==0 ? $rst['model'] : [];
    }
}