<?php
namespace App\Http\Controllers\Admin;

use App\Models\ProductConModel;
use Illuminate\Http\Request;

class ProductConController extends BaseController
{
    /**
     * 系统后台 产品动画的图片文字管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductConModel();
        $this->crumb['']['name'] = '图片文字列表';
        $this->crumb['category']['name'] = '图片文字';
        $this->crumb['category']['url'] = 'productcon';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/productcon',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productCon.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/productcon/trash',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productCon.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productCon.create', $result);
    }

    /**
     * 查询方法
     */
    public function query($del)
    {
        return ProductConModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}