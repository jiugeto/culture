<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiDesign;
use Illuminate\Http\Request;

class DesignController extends BaseController
{
    /**
     * 会员后台：设计管理
     */

    protected $genre;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '设计管理';
        $this->lists['func']['url'] = 'design';
        $this->lists['create']['name'] = '设计发布';
        /*if ($this->userType==50) {       //超级用户
            $this->genre = 0;
        } else */if ($this->userType==4) {       //4设计师
            $this->genre = 1;
        } else if ($this->userType==8) {        //设计公司
            $this->genre = 3;
        } else if (in_array($this->userType,[3,5,6,7])) {        //其他公司
            $this->genre = 4;
        } else {        //其他用户
            $this->genre = 2;
        }
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        if (!$cate) {
            $prefix_url = DOMAIN.'member/design';
        } else {
            $prefix_url = DOMAIN.'member/design/s/'.$cate;
        }
        $apiDesign = ApiDesign::index($this->limit,$pageCurr,$this->userid,$this->genre,$cate,2,0);
        if ($apiDesign['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiDesign['data']; $total = $apiDesign['pagelist']['total'];
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
        return view('member.design.index', $result);
    }

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





    public function getData(Request $request)
    {
        return array(
            'name'=> $request->name,
            'genre'=> $this->genre,
            'cate'=> $request->cate,
            'intro'=> $request->intro,
            'detail'=> $request->detail,
            'money'=> $request->money,
            'uid'=> $this->userid,
        );
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