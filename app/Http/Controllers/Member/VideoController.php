<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiGoods;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    /**
     * 视频管理
     */

    protected $genre;
    protected $genreName;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '视频管理';
        $this->lists['func']['url'] = 'video';
        $this->lists['create']['name'] = '发布视频';
        if ($this->userType==50) {
            $this->genre = [3,4];
        } elseif (in_array($this->userType,[4,5,6])) {
            $this->genre = 3;
            $this->genreName = "视频供应";
        } else {
            $this->genre = 4;
            $this->genreName = "视频需求";
        }
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'member/video';
        $apiGoods = ApiGoods::index($this->limit,$pageCurr,$this->userid,$this->genre,$cate,0,2);
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
        ];
        return view('member.goods.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goods.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiGoods = ApiGoods::add($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/video');
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
            'data'=> $apiGoods['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goods.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiGoods = ApiGoods::modify($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/video');
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
            'data'=> $apiGoods['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goods.show', $result);
    }

    /**
     * 设置缩略图
     */
    public function setThumb(Request $request,$id)
    {
        if (!isset($request->url_ori)) {
            echo "<script>alert('未上传图片！');history.go(-1);</script>";exit;
        } else {
            //获取老图片地址
            $apiGood = ApiGoods::show($id);
            if ($apiGood['code']!=0) {
                echo "<script>alert('".$apiGood['msg']."');history.go(-1);</script>";exit;
            }
            if ($thumbOld=$apiGood['data']['thumb']) {
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
        }
        $data = [
            'thumb' =>  isset($thumb) ? $thumb : '',
            'id'    =>  $id,
        ];
        $apiGoods = ApiGoods::setThumb($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/video');
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
        return redirect(DOMAIN.'member/video');
    }

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $apiUser = ApiUsers::getOneUser($this->userid);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        $data = [
            'name'  =>  $request->name,
            'genre' =>  $this->genre,
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
            'money' =>  $request->money,
            'uid'   =>  $this->userid,
        ];
        return $data;
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