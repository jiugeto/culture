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

    public function index($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $companyModel = CompanyModel::find($company['cid']);
        $result = [
            'job'=> $this->getModule($company['cid']),
            'datas'=> $this->query($company['cid']),
            'company'=> $companyModel,
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'prefix_url'=> $this->prefix_url,
        ];
        return view('company.recruit.index', $result);
    }

    public function query($cid)
    {
        $limit = 10;
        $datas = ComFuncModel::where('cid',$cid)
                    ->where('module_id',4)
                    ->where('isshow',1)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
        $datas->limit = $limit;
        return $datas;
    }

    public function getModule($cid)
    {
        if (count($this->query($cid))) { $job = $this->query($cid)[0]; }
        return isset($job) ? ComModuleModel::find($job->module_id) : '';
    }
}