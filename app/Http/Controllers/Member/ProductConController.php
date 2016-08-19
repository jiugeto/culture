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
            'prefix_url'=> DOMAIN.'member/productcon',
            'curr'=> $curr,
        ];
        return view('member.productcon.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'prefix_url'=> DOMAIN.'member/productcon/trash',
            'curr'=> $curr,
        ];
        return view('member.productcon.index', $result);
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
        return view('member.productcon.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ProductConModel::create($data);
        return redirect(DOMAIN.'member/productcon');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ProductConModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productcon.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ProductConModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'member/productcon');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ProductConModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productcon.show', $result);
    }

    public function destroy($id)
    {
        ProductConModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/productcon');
    }

    public function restore($id)
    {
        ProductConModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/productcon/trash');
    }

    public function forceDelete($id)
    {
        ProductConModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/productcon/trash');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->pic_id && !$request->name) {
            echo "<script>alert('图片、文字必须填选一个！');history.go(-1);</script>";exit;
        }
        $data = [
            'genre'=> $request->genre,
            'pic_id'=> $request->pic_id,
            'name'=> $request->name,
            'productid'=> $request->productid,
            'attrid'=> $request->attrid,
            'intro'=> $request->intro,
        ];
        return $data;
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

    /**
     * 图片样式
     */
    public function picAttrs(){}

    /**
     * 文字样式
     */
    public function textAttrs(){}
}