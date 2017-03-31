<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use Illuminate\Http\Request;

class FirmController extends BaseFuncController
{
    /**
     *  公司服务
     */

    protected $type = 5;        //5代表类型服务
    protected $moduleGnere = 2;        //2代表模块服务

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '服务编辑';
        $this->lists['func']['url'] = 'firms';
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
        return view('company.admin.firm.index', $result);
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
        return view('company.admin.firm.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->module);
        if ($request->small) {
            $data['small'] = mb_substr($request->small,-1,1,'utf-8')=='|'?$request->small:$request->small.'|';
        }
        $data['type'] = $this->type;
        $data['created_at'] = time();
        ComFuncModel::create($data);
        return redirect(DOMAIN_C_BACK.'firms');
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
        return view('company.admin.firm.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->module);
        if ($request->small) {
            $data['small'] = mb_substr($request->small,-1,1,'utf-8')=='|'?$request->small:$request->small.'|';
        }
        $data['type'] = $this->type;
        $data['updated_at'] = time();
        ComFuncModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'company/admin/firm');
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
        return view('company.admin.firm.show', $result);
    }
}