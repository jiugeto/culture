<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductModel;
use Illuminate\Http\Request;

class ProCreationController extends BaseController
{
    /**
     * 系统后台实时创作窗口
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '产品列表';
        $this->crumb['category']['name'] = '产品管理';
        $this->crumb['category']['url'] = 'product';
        $this->model = new ProductModel();
    }

    public function index($productid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->getAttrs($productid),
            'product'=> ProductModel::find($productid),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'curr_url'=> 'play',
        ];
        return view('admin.proCreation.index', $result);
    }

    public function edit($productid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'attrs'=> $this->getAttrs($productid),
            'product'=> ProductModel::find($productid),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'curr_url'=> 'edit',
        ];
        return view('admin.proCreation.edit', $result);
    }






    public function play($productid)
    {
        return view('admin.proCreation.basic.play', array('attrs'=>$this->getAttrs($productid)));
    }

    public function modify($productid)
    {
        return view('admin.proCreation.basic.modify', array('attrs'=>$this->getAttrs($productid)));
    }

    public function getAttrs($productid)
    {
        return ProductAttrModel::where('productid',$productid)->get();
    }
}