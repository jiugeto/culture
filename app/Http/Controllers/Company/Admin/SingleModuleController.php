<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComModuleModel;
//use Symfony\Component\HttpFoundation\Request;
use Illuminate\Http\Request;

class SingleModuleController extends BaseController
{
    /**
     * 企业后台 其他页面（单页）
     */

    protected $genre = 2;       //2代表新加的单页

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
        $result = [
            'datas'=> $this->query(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.singlemodule.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.singlemodule.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComModuleModel::create($data);
        return redirect('/company/admin/singlemodule');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComModuleModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.singlemodule.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComModuleModel::where('id',$id)->update($data);
        return redirect('/company/admin/singlemodule');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ComModuleModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.singlemodule.show', $result);
    }




    public function getData(Request $request)
    {
        if (!$request->intro) { echo "<script>alert('内容不能空！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'genre'=> $this->genre,
            'cid'=> $this->cid,
            'intro'=> $request->intro,
            'sort'=> $request->sort,
            'isshow'=> $request->isshow,
        ];
        return $data;
    }

    public function query()
    {
        return ComModuleModel::where('genre',$this->genre)
                        ->where('cid',$this->cid)
                        ->orderBy('sort','desc')
                        ->orderBy('id','desc')
                        ->paginate($this->limit);
    }
}