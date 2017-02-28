<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiLink;
use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '链接列表';
        $this->crumb['category']['name'] = '链接管理';
        $this->crumb['category']['url'] = 'link';
        $this->crumb['prefix'] = '链接';
    }

    public function index($type=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $prefix_url = DOMAIN.'admin/link';
        $datas = $this->query($pageCurr,$type);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
            'type' => $type,
        ];
        return view('admin.link.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $apiLink = ApiLink::getLinksByPid(0);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'plinks'=> $apiLink['data'],      //得到父链接
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiLink = ApiLink::add($data);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/link');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiLink = ApiLink::getLinksByPid(0);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        $apiLink2 = ApiLink::show($id);
        if ($apiLink2['code']!=0) {
            echo "<script>alert('".$apiLink2['msg']."');history.go(-1);</script>";exit;
        }
        $result =[
            'plinks'=> $apiLink['data'],      //得到父链接
            'model'=> $this->getModel(),
            'types'=> $this->model['types'],
            'data'=> $apiLink2['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiLink = ApiLink::modify($data);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/link');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiLink = ApiLink::show($id);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiLink['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.show', $result);
    }

    /**
     * 设置图片
     */
    public function setThumb(Request $request,$id)
    {
        if (!isset($request->url_ori)) {
            echo "<script>alert('未上传图片！');history.go(-1);</script>";exit;
        }
        //判断老图片
        $apiLink = ApiLink::show($id);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        if ($thumbOld=$apiLink['data']['thumb']) {
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
        $apiLink2 = ApiLink::setThumb($data);
        if ($apiLink2['code']!=0) {
            echo "<script>alert('".$apiLink2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/link');
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiLink = ApiLink::setShow($id,$isshow);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/link');
    }






    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        //判断cid
        if (!$request->cname) {
            $cid = 0;       //代表本站
        } else {
            $apiCompany = ApiCompany::getOneByCname($request->cname);
            if ($apiCompany['code']!=0) {
                echo "<script>alert('发布方填写错误！');history.go(-1);</script>";exit;
            }
            $cid = $apiCompany['data']['id'];
        }
        $data = [
            'name'  =>  $request->name,
            'display_way'   =>  $request->display_way,
            'cid'   =>  $cid,      //0代表本网站
            'title' =>  $request->title,
            'type'  =>  $request->type,
            'intro' =>  $request->intro,
            'link'  =>  $request->link,
            'pid'   =>  $request->pid,
        ];
        return $data;
    }

    public function query($pageCurr,$type)
    {
        $apiLink = ApiLink::index($this->limit,$pageCurr,0,$type,0);
        return $apiLink['code']==0 ? $apiLink['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiLink::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}