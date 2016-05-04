<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\Company\ComModuleModel;

class FirmController extends BaseController
{
    /**
     * 企业后台服务
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '服务项目';
        $this->list['func']['url'] = 'firm';
    }

    public function index()
    {
        $result = [
            'firm'=> $this->getModule(),
            'datas'=> $this->query(),
            'topmenus'=> $this->topmenus,
            'curr'=> 'firm',
        ];
        return view('company.firm.index', $result);
    }

    public function query()
    {
        return ComFuncModel::where('cid',$this->cid)
                        ->where('module_id',2)
                        ->where('isshow',1)
                        ->orderBy('sort','desc')
                        ->orderBy('id','desc')
                        ->get();
    }

    public function getModule()
    {
        if (count($this->query())) { $firm = $this->query()[0]; }
        return isset($firm) ? ComModuleModel::find($firm->module_id) : '';
    }
}