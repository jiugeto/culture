<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use Illuminate\Http\Request;

class JobController extends BaseFuncController
{
    /**
     *  公司招聘
     */

    protected $type = 7;        //7代表类型招聘
    protected $moduleGnere = 4;        //4代表模块招聘

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '招聘编辑';
        $this->lists['func']['url'] = 'job';
        $this->module = $this->getModuleId($this->moduleGnere);
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($this->module,$this->type),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.job.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.job.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->module);
        $data['type'] = $this->type;
        $data['created_at'] = time();
        ComFuncModel::create($data);
        return redirect(DOMAIN.'company/admin/job');
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
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.job.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->module);
        $data['type'] = $this->type;
        $data['updated_at'] = time();
        ComFuncModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'company/admin/job');
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
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.job.show', $result);
    }
}