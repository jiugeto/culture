<?php
namespace App\Http\Controllers\Online;

use App\Models\Online\ProductModel;

class HomeController extends BaseController
{
    /**
     * 在线创作窗口主页
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
            'prefix_url'=> DOMAIN.'online',
            'cate'=> $cate,
        ];
        return view('online.home.index', $result);
    }

    public function show($id)
    {
        $result = [
            'data'=> ProductModel::find($id),
            'layers'=> $this->getLayers($id),
            'cons'=> $this->getCons($id,0),
            'attrs'=> $this->getAttrs($id,0),
            'attrModel'=> $this->attrModel,
            'currUrl'=> 'play',
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
                ->where('isshow',2)
                ->where('isauth',3)
                ->where('uid',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = ProductModel::where('isshow',2)
                ->where('isauth',3)
                ->where('uid',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}