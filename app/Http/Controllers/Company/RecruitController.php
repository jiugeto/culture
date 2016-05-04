<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComModuleModel;
use App\Models\Company\ComFuncModel;
use App\Models\CompanyModel;

class RecruitController extends BaseController
{
    /**
     * 企业后台招聘
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '招聘';
        $this->list['func']['url'] = 'recruit';
    }

    public function index()
    {
        if ($this->cid) { $companyModel = CompanyModel::find($this->cid); }
        $result = [
            'job'=> $this->getModule(),
            'datas'=> $this->query(),
            'company'=> isset($companyModel)?$companyModel:'',
            'topmenus'=> $this->topmenus,
            'curr'=> 'recruit',
        ];
        return view('company.recruit.index', $result);
    }

    public function query()
    {
        $datas = ComFuncModel::where('cid',$this->cid)
                    ->where('module_id',4)
                    ->where('isshow',1)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
//        if (!$datas) {
//            $datas = ComFuncModel::where('cid',0)
//                ->where('isshow',1)
//                ->orderBy('sort','desc')
//                ->orderBy('id','desc')
//                ->get();
//        }
        return $datas;
    }

    public function getModule()
    {
        if (count($this->query())) { $job = $this->query()[0]; }
        return isset($job) ? ComModuleModel::find($job->module_id) : '';
    }
}