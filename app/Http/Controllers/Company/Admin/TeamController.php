<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use Illuminate\Http\Request;

class TeamController extends BaseFuncController
{
    /**
     *  公司团队
     */

    protected $type = 6;        //5代表类型团队
    protected $moduleGnere = 3;        //3代表模块团队

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '团队编辑';
        $this->lists['func']['url'] = 'team';
        $this->module = $this->getModuleId($this->moduleGnere);
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas' => $this->query($this->module,$this->type),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pics'=> $this->pics,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->module);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::create($data);
        return redirect(DOMAIN.'company/admin/team');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'pics'=> $this->pics,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->module);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'company/admin/team');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'pics'=> $this->pics,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.show', $result);
    }
}