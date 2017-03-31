<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use Illuminate\Http\Request;

class TeamController extends BaseController
{
    /**
     *  公司团队
     */

    protected $genre = 6;        //模块类型

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '团队编辑';
        $this->lists['func']['url'] = 'team';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN_C_BACK.'team';
        $result = [
            'datas' => $this->getFuncs($this->cid,$this->genre,$this->limit,$pageCurr,$prefix_url),
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
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->module);
        $data['type'] = $this->type;
        $data['created_at'] = time();
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
        $data['type'] = $this->type;
        $data['updated_at'] = time();
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