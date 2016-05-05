<?php
namespace App\Http\Controllers\Company\Admin;

//use App\Http\Requests\Request;
use Illuminate\Http\Request;
use App\Models\Company\ComFuncModel;

class SingleController extends BaseController
{
    /**
     * 企业后台 其他页面（单页）
     */

    protected $genre = 2;       //2代表新加的单页

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
            'curr'=> $curr,
        ];
        return view('company.admin.single.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'modules'=> $this->model->singelModules($this->cid),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.single.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
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
        ];
        return view('company.admin.single.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
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
        return ComFuncModel::where('genre',$this->genre)
                        ->where('cid',$this->cid)
                        ->orderBy('sort','desc')
                        ->orderBy('id','desc')
                        ->paginate($this->limit);
    }
}