<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiGoods;
use Illuminate\Http\Request;
use Session;

class ProductController extends BaseController
{
    /**
     * 企业开展后台，产品管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '产品编辑';
        $this->lists['func']['url'] = 'product';
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        if (!$cate) {
            $prefix_url = DOMAIN_C_BACK.'product';
        } else {
            $prefix_url = DOMAIN_C_BACK.'product/s/'.$cate;
        }
        $apiGoods = ApiGoods::index($this->limit,$pageCurr,$this->userid,[1,3],0,0,2);
        if ($apiGoods['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiGoods['data']; $total = $apiGoods['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
            'cate' => $cate,
        ];
        return view('company.admin.product.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.product.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiGoods = ApiGoods::add($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'product');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiGoods = ApiGoods::show($id);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiGoods['data'],
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.product.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiGoods = ApiGoods::modify($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'product');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiGoods = ApiGoods::show($id);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiGoods['data'],
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.product.show', $result);
    }

    /**
     * 设置缩略图
     */
    public function setThumb(Request $request,$id)
    {
        if (!isset($request->url_ori)) {
            echo "<script>alert('没有上传图片！');history.go(-1);</script>";exit;
        }
        //获取老图链接
        $apiGoods2 = ApiGoods::show($id);
        if ($apiGoods2['code']!=0) {
            echo "<script>alert('".$apiGoods2['msg']."');history.go(-1);</script>";exit;
        }
        $thumbOldArr[] = $apiGoods2['data']['thumb'] ? $apiGoods2['data']['thumb'] : [];
        $thumb = $this->uploadOnlyImg($request,'url_ori',$thumbOldArr);
        $data = [
            'id'    =>  $id,
            'thumb' =>  $thumb,
        ];
        $apiGoods = ApiGoods::setThumb($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'product');
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
        $data = [
            'id'    =>  $id,
            'linkType'  =>  $linkType,
            'link'  =>  $link,
            'uid'   =>  $this->userid,
        ];
        $apiGoods = ApiGoods::setLink($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'product');
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        //1动画片段供应，2动画片段需求，3视频供应，4视频需求，
        return array(
            'name'      =>  $request->name,
            'genre'     =>  $request->genre,
            'cate'      =>  $request->cate,
            'intro'     =>  $request->intro,
            'uid'       =>  $this->userid,
            'uname'     =>  Session::get('user.username'),
            'money'     =>  $request->money,
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiGoods::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}