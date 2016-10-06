<?php
namespace App\Http\Controllers\Admin;

use App\Models\GoodsModel;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;

class GoodsController extends BaseController
{
    /**
     * 系统后台作品（制作公司和设计师的）管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new GoodsModel();
        $this->crumb['']['name'] = '作品列表';
        $this->crumb['category']['name'] = '用户作品';
        $this->crumb['category']['url'] = 'goods';
    }

    public function index($type=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($type),
            'prefix_url'=> DOMAIN.'admin/goods',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'types'=> $this->model['types'],
            'type'=> $type,
        ];
        return view('admin.goods.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'users'=> $this->model->users(),
            'pics'=> $this->model->pics(0),
            'videos'=> $this->model->videos(0),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.goods.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        GoodsModel::create($data);
        return redirect(DOMAIN.'admin/goods');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'model'=> $this->model,
            'users'=> $this->model->users(),
            'pics'=> $this->model->pics(0),
            'videos'=> $this->model->videos(0),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.goods.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        GoodsModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/goods');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.goods.show', $result);
    }





    public function getData(Request $request)
    {
        if (!$request->uid) {
            echo "<script>alert('用户必选！');history.go(-1);</script>";exit;
        }
        if (!$request->pic_id) {
            echo "<script>alert('缩略图必选！');history.go(-1);</script>";exit;
        }
        return array(
            'name'=> $request->name,
            'genre'=> $request->genre,
            'type'=> $request->type,
            'cate'=> $request->cate,
            'intro'=> $request->intro,
            'pic_id'=> $request->pic_id,
            'video_id'=> $request->video_id,
            'title'=> $request->title,
            'money'=> $request->money,
        );
    }

    /**
     * 查询方法
     */
    public function query($type=0)
    {
        if ($type) {
            $datas = GoodsModel::where('del',0)
                ->where('type',$type)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = GoodsModel::where('del',0)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}