<?php
namespace App\Http\Controllers\Company;

class ProductController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        $this->list['func']['name'] = '产品';
        $this->list['func']['url'] = 'product';
    }

    public function index()
    {
        $result = [
            'topmenus'=> $this->topmenus,
            'curr'=> 'product',
        ];
        return view('company.product.index', $result);
    }
}