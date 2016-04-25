<?php
namespace App\Http\Controllers\Company;

class ContactController extends BaseController
{
    /**
     * 企业后台团队
     */

    public function __construct()
    {
        $this->list['func']['name'] = '团队';
        $this->list['func']['url'] = 'contact';
    }

    public function index()
    {
        $result = [
            'topmenus'=> $this->topmenus,
            'curr'=> 'contact',
        ];
        return view('company.contact.index', $result);
    }
}