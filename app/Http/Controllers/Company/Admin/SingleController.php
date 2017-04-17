<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiComFunc;
use App\Api\ApiBusiness\ApiComModule;
use Illuminate\Http\Request;

class SingleController extends BaseController
{
    /**
     * 企业后台 其他页面（单页）
     */

    protected $genre = 21;       //21代表新加的单页

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '其他页面';
        $this->lists['func']['url'] = 'single';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN_C_BACK.'single';
        $apiSingle = ApiComFunc::getSingleList($this->limit,$pageCurr,$this->cid,0,0);
        if ($apiSingle['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiSingle['data']; $total = $apiSingle['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'modules' => $this->getSingleModules(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.single.index', $result);
    }

    public function create()
    {
        //判断有无该公司的扩展单页
        $apiModule = ApiComModule::index($this->limit,1,$this->cid,0);
        if ($apiModule['code']!=0) {
            echo "<script>alert('没有单页模模块，请添加！');history.go(-1);</script>";exit;
        }
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'modules' => $this->getSingleModules(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.single.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getSingleData($request);
        $apiSingle = ApiComFunc::add($data);
        if ($apiSingle['code']!=0) {
            echo "<script>alert('".$apiSingle['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'single');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiSingle = ApiComFunc::show($id);
        if ($apiSingle['code']!=0) {
            echo "<script>alert('".$apiSingle['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiSingle['data'],
            'modules' => $this->getSingleModules(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.single.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getSingleData($request);
        $data['id'] = $id;
        $apiSingle = ApiComFunc::modify($data);
        if ($apiSingle['code']!=0) {
            echo "<script>alert('".$apiSingle['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'single');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiSingle = ApiComFunc::show($id);
        if ($apiSingle['code']!=0) {
            echo "<script>alert('".$apiSingle['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiSingle['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.single.show', $result);
    }




    public function getSingleData(Request $request)
    {
        if (!$request->intro) { echo "<script>alert('比如不能空！');history.go(-1);</script>";exit; }
        $data = [
            'name'  =>  $request->name,
            'cid'   =>  $this->cid,
            'module_id' =>  $request->module_id,
            'intro' =>  $request->intro,
            'small' =>  '',
        ];
        return $data;
    }

    /**
     * 获取该企业所有单页模块
     */
    public function getSingleModules()
    {
        $apiSingleModule = ApiComModule::getSingleModuleList(1000,1,$this->cid,0);
        return $apiSingleModule['code']==0 ? $apiSingleModule['data'] : [];
    }
}