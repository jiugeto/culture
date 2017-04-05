<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiComFunc;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    /**
     *  关于公司
     */

    protected $genre = 1;        //模块类型

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '关于公司';
        $this->lists['func']['url'] = 'about';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN_C_BACK.'about';
        $rstFunc = $this->getFuncs($this->cid,$this->genre,$this->limit,$pageCurr,$prefix_url);
        $result = [
            'datas' => $rstFunc['datas'],
            'pagelist' => $rstFunc['pagelist'],
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.about.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model' => $this->model,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.about.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->genre);
        $apiFunc = ApiComFunc::add($data);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'about');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiFunc = ApiComFunc::show($id);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiFunc['data'],
            'model' => $this->model,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.about.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->genre);
        $data['id'] = $id;
        $apiFunc = ApiComFunc::add($data);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'about');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiFunc = ApiComFunc::show($id);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiFunc['data'],
            'model' => $this->model,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.about.show', $result);
    }
}