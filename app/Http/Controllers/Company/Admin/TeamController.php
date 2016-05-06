<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use Illuminate\Http\Request;

class TeamController extends BaseFuncController
{
    /**
     *  公司团队
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '团队编辑';
        $this->lists['func']['url'] = 'team';
        $this->module = $this->getModuleId(3);
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
        return view('company.admin.team.index', $result);
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
        return view('company.admin.team.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->module);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::create($data);
        return redirect('/company/admin/team');
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
        return view('company.admin.team.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->module);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::where('id',$id)->update($data);
        return redirect('/company/admin/team');
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
        return view('company.admin.team.show', $result);
    }
}