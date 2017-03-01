<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiDesign;
use Illuminate\Http\Request;

class DesignController extends BaseController
{
    /**
     * 会员后台：设计管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '设计管理';
        $this->lists['func']['url'] = 'design';
        $this->lists['create']['name'] = '设计发布';
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'member/design';
        $datas = $this->query($pageCurr,$cate);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.design.index', $result);
    }

//    public function trash($cate=0)
//    {
//        $curr['name'] = $this->lists['trash']['name'];
//        $curr['url'] = $this->lists['trash']['url'];
//        $result = [
//            'datas'=> $this->query($this->genre,$del=1,$cate),
//            'model'=> $this->model,
//            'prefix_url'=> DOMAIN.'member/design/trash',
//            'lists'=> $this->lists,
//            'curr'=> $curr,
//        ];
//        return view('member.design.index', $result);
//    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists' => $this->lists,
            'model' => $this->getModel(),
            'curr' => $curr,
        ];
        return view('member.design.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiDesign = ApiDesign::add($data);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
//        //插入搜索表
//        $designModel = DesignModel::where($data)->first();
//        \App\Models\Home\SearchModel::change($designModel,9,'create');
        return redirect(DOMAIN.'member/design');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiDesign = ApiDesign::show($id);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiDesign['data'],
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.design.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiDesign = ApiDesign::modify($data);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
//        //更新搜索表
//        $designModel = DesignModel::where('id',$id)->first();
//        \App\Models\Home\SearchModel::change($designModel,9,'update');
        return redirect(DOMAIN.'member/design');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiDesign = ApiDesign::show($id);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiDesign['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.design.show', $result);
    }

//    public function destroy($id)
//    {
//        DesignModel::where('id',$id)->update(array('del'=> 1));
//        return redirect(DOMAIN.'member/design');
//    }





    public function getData(Request $request)
    {
        return array(
            'name'=> $request->name,
            'genre'=> $request->genre,
            'cate'=> $request->cate,
            'intro'=> $request->intro,
            'detail'=> $request->detail,
            'money'=> $request->money,
            'uid'=> $this->userid,
        );
    }

    public function query($pageCurr,$cate)
    {
        $uid = $this->userType==50 ? 0 : $this->userid;
        $apiDesign = ApiDesign::index($this->limit,$pageCurr,$uid,0,$cate,2,0);
        return $apiDesign['code']==0 ? $apiDesign['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiDesign::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}