<?php
namespace App\Http\Controllers\Company;

class ProductController extends BaseController
{
    /**
     * 企业后台产品
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '产品';
        $this->list['func']['url'] = 'product';
    }

    public function index($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $result = [
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'curr'=> $this->prefix_url,
        ];
        return view('company.product.index', $result);
    }
}