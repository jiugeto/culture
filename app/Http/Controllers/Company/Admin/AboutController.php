<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    /**
     *  关于公司
     */

    protected $module = 1;        //1代表公司介绍

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '关于公司';
        $this->lists['func']['url'] = 'about';
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
        return view('company.admin.about.index', $result);
    }

    public function edit()
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> $this->query($this->type),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.about.edit', $result);
    }

    public function update(){}





    public function query()
    {
        return ComFuncModel::where('cid',$this->cid)
            ->where('module_id',$this->module)
            ->paginate($this->limit);
    }
}