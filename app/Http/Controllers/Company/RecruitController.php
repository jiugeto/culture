<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComJobModel;
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
            'datas'=> $this->query(),
            'company'=> isset($companyModel)?$companyModel:'',
            'topmenus'=> $this->topmenus,
            'curr'=> 'recruit',
        ];
        return view('company.recruit.index', $result);
    }

    public function query()
    {
        $datas = ComJobModel::where('del',0)
                    ->where('cid',$this->cid)
                    ->where('isshow',1)
                    ->where('isshow2',1)
                    ->orderBy('istop','desc')
                    ->orderBy('istop2','desc')
                    ->orderBy('sort','desc')
                    ->orderBy('sort2','desc')
                    ->orderBy('id','desc')
                    ->get();
        if (!$datas) {
            $datas = ComJobModel::where('cid',0)
                ->where('isshow',1)
                ->orderBy('istop','desc')
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->get();
        }
        return $datas;
    }
}