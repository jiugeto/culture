<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiHuaxu;
use Illuminate\Http\Request;
use Session;

class PartController extends BaseController
{
    /**
     * 企业后台，花絮管理
     */

    protected $genre;       //噶类型

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '花絮编辑';
        $this->lists['func']['url'] = 'part';
        $this->genre = $this->getHuaxuType();
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN_C_BACK.'part';
        $apiHuaxu = ApiHuaxu::index($this->limit,$pageCurr,$this->userid,$this->genre,0);
        if ($apiHuaxu['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiHuaxu['data']; $total = $apiHuaxu['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
            'cate' => $cate,
        ];
        return view('company.admin.part.index', $result);
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
        return view('company.admin.part.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getPartData($request);
        $apiHuaxu = ApiHuaxu::add($data);
        if ($apiHuaxu['code']!=0) {
            echo "<script>alert('".$apiHuaxu['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'part');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiHuaxu = ApiHuaxu::show($id);
        if ($apiHuaxu['code']!=0) {
            echo "<script>alert('".$apiHuaxu['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiHuaxu['data'],
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.part.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getPartData($request);
        $apiHuaxu = ApiHuaxu::modify($data);
        if ($apiHuaxu['code']!=0) {
            echo "<script>alert('".$apiHuaxu['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'part');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiHuaxu = ApiHuaxu::show($id);
        if ($apiHuaxu['code']!=0) {
            echo "<script>alert('".$apiHuaxu['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiHuaxu['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.part.show', $result);
    }





    /**
     * 收集数据
     */
    public function getPartData(Request $request)
    {
        return array(
            'genre'     =>  $request->genre,
            'name'      =>  $request->name,
            'intro'     =>  $request->intro,
            'uid'       =>  $this->userid,
            'uname'     =>  Session::get('user.username'),
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiHuaxu::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }

    /**
     * 由公司类型确定花絮类型
     */
    public function getHuaxuType()
    {
        //会员身份：1普通用户，2个人会员，3普通企业，4设计师，5广告公司，6影视公司，7租赁公司，8设计公司，50超级用户
        //花絮类型：1样片花絮，2故事脚本花絮，3租赁花絮，4娱乐花絮，5设计花絮
        $type = Session::get('user.userType');
        if ($type==5) {
            $huaxuType = array(1,2);
        } else if ($type==6) {
            $huaxuType = array(1,2,4);
        } else if ($type==7) {
            $huaxuType = array(3);
        } else if ($type==8) {
            $huaxuType = array(5);
        } else if ($type==50) {
            $huaxuType = array(1,2,3,4,5);
        } else {
            $huaxuType = array();
        }
        return $huaxuType;
    }
}