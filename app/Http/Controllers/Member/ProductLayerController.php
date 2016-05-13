<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductLayerModel;
use Illuminate\Http\Request;

class ProductLayerController extends BaseController
{
    /**
     * 会员后台 产品动画
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '产品动画';
        $this->lists['func']['url'] = 'productlayer';
        $this->lists['create']['name'] = '添加动画';
        $this->model = new ProductLayerModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/productlayer',
            'curr'=> $curr,
        ];
        return view('member.productlayer.index', $result);
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductLayerModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}