<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiIdea;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    /**
     * 用户日志管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '创意列表';
        $this->crumb['category']['name'] = '创意管理';
        $this->crumb['category']['url'] = 'idea';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/idea';
        $apiIdea = ApiIdea::index($this->limit,$pageCurr,0,0,0,0);
        if ($apiIdea['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiIdea['data']; $total = $apiIdea['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.idea.index', $result);
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
        return view('admin.idea.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiIdea = ApiIdea::add($data);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/idea');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiIdea = ApiIdea::show($id);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiIdea['data'],
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.idea.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiIdea = ApiIdea::modify($data);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/idea');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiIdea = ApiIdea::show($id);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiIdea['data'],
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.idea.show', $result);
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiIdea = ApiIdea::setShow($id,$isshow);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/idea');
    }





    public function getData(Request $request)
    {
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('发布方名称错误！');history.go(-1);</script>";exit;
        }
        return array(
            'name'  =>  $request->name,
            'genre' =>  $request->genre,
            'cate'  =>  $request->cate,
            'uid'   =>  $apiUser['data']['id'],
            'intro' =>  $request->intro,
            'isdetail'  =>  $request->isdetail,
            'detail'    =>  $request->detail,
            'money'     =>  $request->money,
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiIdea::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}