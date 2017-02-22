<?php
namespace App\Http\Controllers\Member;
use App\Api\ApiBusiness\ApiGoods;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class GoodsController extends BaseController
{
    /**
     * 个人会员需求管理
     * goods 商品、货物，代表文化类产品
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '视频管理';
        $this->lists['func']['url'] = 'goods';
        $this->lists['create']['name'] = '发布视频';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'member/goods';
        $datas = $this->query($pageCurr,0);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
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
//        //插入搜索表
//        $goodsModel = GoodsModel::where($data)->first();
//        \App\Models\Home\SearchModel::change($goodsModel,2,'create');
        return redirect(DOMAIN.'member/goods');
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
//        //更新搜索表
//        $goodsModel = GoodsModel::where('id',$id)->first();
//        \App\Models\Home\SearchModel::change($goodsModel,2,'update');
        return redirect(DOMAIN.'member/goods');
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
        return redirect(DOMAIN.'member/goods');
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
        return redirect(DOMAIN.'member/goods');
    }

//    public function destroy($id)
//    {
//        GoodsModel::where('id',$id)->update(['del'=> 1]);
//        return redirect(DOMAIN.'member/goods');
//    }
//
//    public function restore($id)
//    {
//        GoodsModel::where('id',$id)->update(['del'=> 0]);
//        return redirect(DOMAIN.'member/goods/trash');
//    }
//
//    public function forceDelete($id)
//    {
//        GoodsModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'member/goods/trash');
//    }

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $apiUser = ApiUsers::getOneUser($this->userid);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        $userType = $apiUser['data']['isuser'];
        if (in_array($userType,[1,2])) {
            $genre = 1;  //个人需求
        } elseif ($userType==4) {
            $genre = 2;  //个人供应
        } elseif (in_array($userType,[3,7])) {
            $genre = 3;  //企业需求
        } else {
            $genre = 4;  //企业供应
        }
        $data = [
            'name'  =>  $request->name,
            'genre' =>  $genre,
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
            'money' =>  $request->money,
            'uid'   =>  $this->userid,
            'uname'=> \Session::get('user.username'),
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($pageCurr,$del)
    {
        $apiGoods = ApiGoods::index($this->limit,$pageCurr,$this->userid,0,0,$del,2,0,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
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