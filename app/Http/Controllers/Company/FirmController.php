<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\Company\ComModuleModel;

class FirmController extends BaseController
{
    /**
     * 企业后台服务
     */

    protected $moduleid;
    protected $genre = 2;       //此处2代表公司服务

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '服务项目';
        $this->list['func']['url'] = 'firm';
    }

    public function index($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $this->moduleid = $this->getModuleId($company['cid'],$this->genre);
        $result = [
            'firm'=> $this->getModule(),
            'datas'=> $this->query(),
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'curr'=> $this->prefix_url,
        ];
        return view('company.firm.index', $result);
    }

    public function query()
    {
        return ComFuncModel::where('cid',$this->cid)
                        ->where('module_id',$this->moduleid)
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