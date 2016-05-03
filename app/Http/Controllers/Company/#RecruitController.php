<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComMainModel;

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
        $result = [
            'data'=> $this->query(),
            'topmenus'=> $this->topmenus,
            'curr'=> 'recruit',
        ];
        return view('company.recruit.index', $result);
    }

    public function query()
    {
        $data = ComMainModel::where('cid',$this->cid)->get();
        $data->jobs = $data->job?explode('|',$data->job):[];
        $data->jobNums = $data->job_num?explode('|',$data->job_num):0;
        $data->jobRequires = $data->job_require?explode('|',$data->job_require):[];
        return $data;
    }
}