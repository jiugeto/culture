<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiComModule;
use Illuminate\Http\Request;

class SingleModuleController extends BaseController
{
    /**
     * 企业后台 其他页面（单页）
     */

    protected $genre = 51;       //模块类型

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '模块列表';
        $this->lists['func']['url'] = 'singlemodule';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN_C_BACK.'singlemodule';
        $apiSingleModule = ApiComModule::getSingleModuleList($this->limit,$pageCurr,$this->cid,0);
        if ($apiSingleModule['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiSingleModule['data']; $total = $apiSingleModule['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.singlemodule.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.singlemodule.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getSingleModuleData($request);
        $apiModule = ApiComModule::add($data);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'singlemodule');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiModule = ApiComModule::show($id);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiModule['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.singlemodule.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getSingleModuleData($request);
        $data['id'] = $id;
        $apiModule = ApiComModule::modify($data);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'singlemodule');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiModule = ApiComModule::show($id);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiModule['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.singlemodule.show', $result);
    }




    public function getSingleModuleData(Request $request)
    {
        if (!$request->intro) { echo "<script>alert('内容不能空！');history.go(-1);</script>";exit; }
        return array(
            'name'  =>  $request->name,
            'genre' =>  51,
            'cid'   =>  $this->cid,
            'intro' =>  $request->intro,
        );
    }
}