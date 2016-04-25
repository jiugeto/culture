<?php
namespace App\Http\Controllers\Company;

class BriefController extends BaseController
{
    /**
     * 企业后台花絮
     */

    public function __construct()
    {
        $this->list['func']['name'] = '花絮';
        $this->list['func']['url'] = 'brief';
    }

    public function index()
    {
        $result = [
            'topmenus'=> $this->topmenus,
            'curr'=> 'brief',
        ];
        return view('company.brief.index', $result);
    }
}