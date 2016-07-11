<?php
namespace App\Http\Controllers\Home;

use App\Models\GoodsModel;
use App\Models\VideoModel;

class ProductController extends BaseController
{
    /**
     * 网站首页产品样片
     */

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'curr_menu'=> 'product',
        ];
        return view('home.product.index', $result);
    }

//    public function show($id)
//    {
//        return view('home.product.show');
//    }

    public function video($videoid)
    {
        $data = $videoid ? VideoModel::find($videoid) : '';
        return view('layout.videoPre', compact('data'));
    }




    public function query()
    {
        return GoodsModel::where('isshow',1)
            ->where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}