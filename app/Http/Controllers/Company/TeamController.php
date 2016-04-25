<?php
namespace App\Http\Controllers\Company;

class TeamController extends BaseController
{
    /**
     * 企业后台团队
     */

    public function __construct()
    {
        $this->list['func']['name'] = '团队';
        $this->list['func']['url'] = 'team';
    }

    public function index()
    {
        $result = [
            'topmenus'=> $this->topmenus,
            'curr'=> 'team',
        ];
        return view('company.team.index', $result);
    }
}