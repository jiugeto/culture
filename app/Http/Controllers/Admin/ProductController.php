<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    /**
     * 系统后台产品管理
     */

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '产品管理',
            'url'=> 'product',
        ],
    ];
}