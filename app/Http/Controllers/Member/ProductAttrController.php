<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductAttrModel;
use Illuminate\Http\Request;

class ProductAttrController extends BaseController
{
    /**
     * 会员后台 在线动画 属性管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '产品属性';
        $this->lists['func']['url'] = 'productattr';
        $this->lists['create']['name'] = '添加属性';
        $this->model = new ProductAttrModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/productattr',
            'curr'=> $curr,
        ];
        return view('member.productattr.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/productattr/trash',
            'curr'=> $curr,
        ];
        return view('member.productattr.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productattr.create', $result);
    }

    public function store(Request $request)
    {
        return redirect('/member/productattr');
    }

    public function edit()
    {
        $result = [];
        return view('member.productattr.edit', $result);
    }

    public function update(Request $request,$id)
    {
        return redirect('/member/prioductattr');
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductAttrModel::where('del',$del)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
    }
}