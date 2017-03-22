<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiOnline\ApiTemp;
use Illuminate\Http\Request;

class ProTempController extends BaseController
{
    /**
     * 在线创作模板
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '产品模板列表';
        $this->crumb['category']['name'] = '产品模板管理';
        $this->crumb['category']['url'] = 'temp';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/product';
        $apiTemp = ApiTemp::index($this->limit,$pageCurr,0,0);
        if ($apiTemp['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiTemp['data']; $total = $apiTemp['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.protemp.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiTemp = ApiTemp::show($id);
        if ($apiTemp['code']!=0) {
            echo "<script>alert('".$apiTemp['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiTemp['data'],
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.protemp.show', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.protemp.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiTemp = ApiTemp::add($data);
        if ($apiTemp['code']!=0) {
            echo "<script>alert('".$apiTemp['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/temp');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiTemp = ApiTemp::show($id);
        if ($apiTemp['code']!=0) {
            echo "<script>alert('".$apiTemp['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiTemp['data'],
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.protemp.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiTemp = ApiTemp::modify($data);
        if ($apiTemp['code']!=0) {
            echo "<script>alert('".$apiTemp['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/temp');
    }

    /**
     * 设置缩略图
     */
    public function setThumb(Request $request,$id)
    {
        if (!isset($request->url_ori)) {
            echo "<script>alert('未上传图片！');history.go(-1);</script>";exit;
        }
        //判断老图片
        $apiTemp = ApiTemp::show($id);
        if ($apiTemp['code']!=0) {
            echo "<script>alert('".$apiTemp['msg']."');history.go(-1);</script>";exit;
        }
        if ($thumbOld=$apiTemp['data']['thumb']) {
            $thumbArr = explode('/',$thumbOld);
            unset($thumbArr[0]); unset($thumbArr[1]); unset($thumbArr[2]);
            $path = implode('/',$thumbArr);
        }
        $pathOld = isset($path) ? $path : '';
        //上传图片
        $rstArr=$this->uploadOnlyImg($request->url_ori,$pathOld);
        if ($rstArr['code']!=0) {
            echo "<script>alert('".$rstArr['msg']."');history.go(-1);</script>";exit;
        }
        $thumb = $rstArr['data'];
        $data = [
            'thumb' =>  isset($thumb) ? $thumb : '',
            'id'    =>  $id,
        ];
        $apiTemp2 = ApiTemp::setThumb($data);
        if ($apiTemp2['code']!=0) {
            echo "<script>alert('".$apiTemp2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/temp');
    }

    /**
     * 设置视频链接
     */
    public function setLink(Request $request,$id)
    {
        $linkType = $request->linkType;
        $link = $request->link;
        if (!$linkType || !$link || !$id) {
            echo "<script>alert('数据有误！');history.go(-1);</script>";exit;
        }
        if ($linkType==1 && (mb_substr($link,0,4)!='http'||mb_substr($link,mb_strlen($link)-4,4)!='.swf')) {
            echo "<script>alert('Flash代码格式有误！');history.go(-1);</script>";exit;
        } elseif ($linkType==2 && mb_substr($link,0,6)!='<embed') {
            echo "<script>alert('html代码格式有误！');history.go(-1);</script>";exit;
        } elseif ($linkType==3 && mb_substr($link,0,7)!='<iframe') {
            echo "<script>alert('html代码格式有误！');history.go(-1);</script>";exit;
        }
        $apiTemp = ApiTemp::show($id);
        if ($apiTemp['code']!=0) {
            echo "<script>alert('".$apiTemp['msg']."');history.go(-1);</script>";exit;
        }
        $data = [
            'id'    =>  $id,
            'linkType'  =>  $linkType,
            'link'  =>  $link,
        ];
        $apiTemp2 = ApiTemp::setLink($data);
        if ($apiTemp2['code']!=0) {
            echo "<script>alert('".$apiTemp2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/temp');
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiTemp = ApiTemp::setShow($id,$isshow);
        return redirect(DOMAIN.'admin/temp');
    }





    public function getData(Request $request)
    {
        return array(
            'name'  =>  $request->name,
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiTemp::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}