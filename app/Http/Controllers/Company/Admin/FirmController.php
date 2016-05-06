<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use Illuminate\Http\Request;

class FirmController extends BaseFuncController
{
    /**
     *  公司服务
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '服务编辑';
        $this->lists['func']['url'] = 'firms';
        $this->module = $this->getModuleId($genre=2);
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas' => $this->query($this->module),
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('company.admin.firm.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pics'=> $this->pics,
//            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.firm.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->module);
        if ($request->small) {
            $data['small'] = mb_substr($request->small,-1,1,'utf-8')=='|'?$request->small:$request->small.'|';
        }
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::create($data);
        return redirect('/company/admin/firms');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'pics'=> $this->pics,
//            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.firm.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->module);
        if ($request->small) {
            $data['small'] = mb_substr($request->small,-1,1,'utf-8')=='|'?$request->small:$request->small.'|';
        }
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::where('id',$id)->update($data);
        return redirect('/company/admin/firms');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'pics'=> $this->pics,
//            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.firm.show', $result);
    }
}