<?php
namespace App\Http\Controllers\Company\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComFuncModel;
use App\Models\Company\ComModuleModel;

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
        $this->model = new ComFuncModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'modules'=> $this->model->singelModules($this->cid),
            'lists'=> $this->lists,
            'prefix_url'=> DOMAIN.'company/admin/single',
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.single.index', $result);
    }

    public function create()
    {
        //判断有无该公司的扩展单页
        if (!count(ComModuleModel::where('cid',$this->cid)->get())) {
            echo "<script>alert('没有单页模，先去添加模块！');history.go(-1);</script>";exit;
        }
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'modules'=> $this->model->singelModules($this->cid),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.single.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ComFuncModel::create($data);
      return redirect('/company/admin/single');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'modules'=> $this->model->singelModules($this->cid),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.single.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ComFuncModel::where('id',$id)->update($data);
        return redirect('/company/admin/single');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'modules'=> $this->model->singelModules($this->cid),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.single.show', $result);
    }




    public function getData(Request $request)
    {
        if (!$request->intro) { echo "<script>alert('比如不能空！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'cid'=> $this->cid,
            'module_id'=> $request->module_id,
            'genre'=> $this->genre,
            'intro'=> $request->intro,
            'sort'=> $request->sort,
            'isshow'=> $request->isshow,
        ];
        return $data;
    }

    public function query()
    {
        $datas = ComFuncModel::where('cid',$this->cid)
            //type>20，为其他单页
            ->where('type','>',20)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}