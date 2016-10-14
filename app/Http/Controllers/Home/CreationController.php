<?php
namespace App\Http\Controllers\Home;

use App\Models\Online\ProductModel;
use App\Models\Online\ProductVideoModel;

class CreationController extends BaseController
{
    /**
     * 网站前台创作窗口
     */

    protected $limit = 20;      //每页显示记录数

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }

    public function index($genre=1,$cate=0)
    {
        $result = [
            'datas'=> $this->query($genre,$cate),
            'prefix_url'=> DOMAIN.'creation',
            'model'=> $this->model,
            'curr_menu'=> 'creation',
            'genre'=> $genre,
            'cate'=> $cate,
        ];
        return view('home.creation.index', $result);
    }

    /**
     * 在线创作作品预览
     */
    public function pre($id)
    {
        $data = ProductModel::find($id);
        $result = [
            'video'=> $data->getVideo(),
            'videoName'=> $data->name,
        ];
        return view('layout.videoPre', $result);
    }






    public function query($genre,$cate)
    {
        if ($genre==1) {
            if ($cate) {
                $datas = ProductModel::where('cate',$cate)
                    ->where('video_id','>',0)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = ProductModel::where('video_id','>',0)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        } elseif (in_array($genre,[2,3])) {
            $datas = ProductVideoModel::where('cate',$cate)
                ->where('genre',$genre-1)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}