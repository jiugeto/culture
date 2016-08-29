<?php
namespace App\Http\Controllers\Company;

class PartController extends BaseController
{
    /**
     * 企业后台花絮
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '花絮';
        $this->list['func']['url'] = 'part';
    }

    public function index($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $result = [
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'curr'=> $this->prefix_url,
        ];
        return view('company.part.index', $result);
    }
}