<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use App\Models\Company\ComModuleModel;
use Illuminate\Http\Request;

class AboutController extends BaseFuncController
{
    /**
     *  关于公司
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '关于公司';
        $this->lists['func']['url'] = 'about';
        $this->module = $this->getModuleId($genre=1);
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($this->module),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.about.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.about.create', $result);
    }

    public function store(Request $request)
    {
        //排除简介的唯一性
        if (in_array($request->type,[1,2])) {
            $aboutModel = ComFuncModel::where('cid',$this->cid)
                ->where('module_id',$this->module)
                ->where('type',$request->type)
                ->first();
            if ($aboutModel) { echo "<script>alert('已有公司简介或公司历程！');history.go(-1);</script>";exit; }
        }
        $data = $this->getData($request,$this->module);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::create($data);
        return redirect('/company/admin/about');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.about.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->module);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::where('id',$id)->update($data);
        return redirect('/company/admin/about');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.about.show', $result);
    }
}