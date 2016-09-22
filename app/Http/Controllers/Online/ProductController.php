<?php
namespace App\Http\Controllers\Online;

use App\Models\Online\ProductModel;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * 在线创作用户编辑
     */

    protected $limit = 12;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }

    public function index($cate=0)
    {
        $result = [
            'datas'=> $this->query($cate),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'online/u/product',
            'cate'=> $cate,
        ];
        return view('online.home.index', $result);
    }

    public function getPro($id)
    {
        $productModel = ProductModel::find($id);
        if ($productModel->uid==$this->userid) {
            echo "<script>alert('自己的创作，不能获取！');history.go(-1);</script>";exit;
        }
        $productModel2 = ProductModel::where('uid',$this->userid)->where('serial',$productModel->serial)->first();
        if ($productModel2) {
            echo "<script>alert('已获取过此创作，不能重复获取！');history.go(-1);</script>";exit;
        }
        //复制product记录
        //复制attr记录
        //复制layer记录
        //复制con记录
        //复制layerattr记录
        dd($id);
    }

    public function show($id)
    {
        $result = [
            'data'=> ProductModel::find($id),
        ];
        return view('online.home.show', $result);
    }




    /**
     * 以下是要展示的数据
     */

    public function query($cate)
    {
        if ($cate) {
            $datas = ProductModel::where('cate',$cate)
                ->where('uid',$this->userid)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = ProductModel::where('isshow',1)
                ->where('uid',$this->userid)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}