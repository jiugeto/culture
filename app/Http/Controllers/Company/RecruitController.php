<?php
namespace App\Http\Controllers\Company;

class RecruitController extends BaseController
{
    /**
     * 企业后台团队
     */

    public function __construct()
    {
        $this->list['func']['name'] = '团队';
        $this->list['func']['url'] = 'recruit';
    }

    public function index()
    {
        $result = [
            'topmenus'=> $this->topmenus,
            'curr'=> 'recruit',
        ];
        return view('company.recruit.index', $result);
    }
}