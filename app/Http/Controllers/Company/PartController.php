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
        $this->list['func']['url'] = 'part';
    }

    public function index()
    {
        $result = [
            'topmenus'=> $this->topmenus,
            'curr'=> 'part',
        ];
        return view('company.part.index', $result);
    }
}