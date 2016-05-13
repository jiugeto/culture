<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductConModel;
use Illuminate\Http\Request;

class ProductConController extends BaseController
{
    /**
     * 会员后台 产品内容
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '产品内容';
        $this->lists['func']['url'] = 'productcon';
        $this->lists['create']['name'] = '添加内容';
        $this->model = new ProductConModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/productcon',
            'curr'=> $curr,
        ];
        return view('member.productcon.index', $result);
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductConModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}