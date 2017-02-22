<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiGoods;
use Illuminate\Http\Request;

class GoodsController extends BaseController
{
    /**
     * 系统后台作品（制作公司和设计师的）管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '作品列表';
        $this->crumb['category']['name'] = '用户作品';
        $this->crumb['category']['url'] = 'goods';
    }

    public function index($genre=0,$cate=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/goods';
        $datas = $this->query($pageCurr,$genre,$cate);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
            'model' => $this->getModel(),
            'genre' => $genre,
            'cate' => $cate,
        ];
        return view('admin.goods.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.goods.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiGoods = ApiGoods::add($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/goods');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiGoods = ApiGoods::show($id);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiGoods['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.goods.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiGoods = ApiGoods::modify($data);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/goods');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $apiGoods = ApiGoods::show($id);
        if ($apiGoods['code']!=0) {
            echo "<script>alert('".$apiGoods['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiGoods['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.goods.show', $result);
    }





    public function getData(Request $request)
    {
        $uid = UserIdByUname($request->uname);
        if (!$uid) {
            echo "<script>alert('用户必选！');history.go(-1);</script>";exit;
        }
        $userType = UserTypeById($uid);
        if (in_array($userType,[1,2])) {
            $genre = 1;     //个人需求
        } elseif ($userType==4) {
            $genre = 2;     //个人供应
        } elseif (in_array($userType,[3,7])) {
            $genre = 3;     //企业需求
        } elseif (in_array($userType,[5,6])) {
            $genre = 4;     //企业供应
        } else {
            $genre = 1;     //userType==50，超级用户默认1
        }
        return array(
            'name'  =>  $request->name,
            'genre' =>  $genre,
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
            'money' =>  $request->money,
            'uid'   =>  $uid,
            'uname' =>  $request->uname
        );
    }

    /**
     * 查询方法
     */
    public function query($pageCurr,$genre,$cate=0)
    {
        $apiGoods = ApiGoods::index($this->limit,$pageCurr,0,$genre,$cate,0,2,0,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiGoods::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : '';
    }
}