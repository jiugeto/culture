<?php
namespace App\Http\Controllers\Home;

class ProductController extends BaseController
{
    /**
     * 网站首页
     */

    public function index()
    {
        $result = [
            'curr'=> 'product',
        ];
        return view('home.product.index', $result);
    }
}