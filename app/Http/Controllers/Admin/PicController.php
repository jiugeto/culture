<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PicModel;

class PicController extends BaseController
{
    /**
     * 图片管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new PicModel();
        $this->crumb['']['name'] = '图片列表';
        $this->crumb['category']['name'] = '图片管理';
        $this->crumb['category']['url'] = 'pic';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> PicModel::paginate($this->limit),
            'prefix_url'=> '/admin/pic',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        PicModel::saveSize();      //确定图片存储
        return view('admin.pic.index', $result);
    }

    public function create($type_id=0)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'type_id'=> $type_id,
        ];
        return view('admin.pic.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        PicModel::create($data);
        return redirect('/admin/pic');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> PicModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.pic.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        PicModel::where('id',$id)->update($data);
        return redirect('/admin/pic');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> PicModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.pic.show', $result);
    }





    /**
     * ======================
     * 以下是公用方法
     * ======================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        //获取图片文件名
        $data['url_ori'] = '';
        if($request->hasFile('url_ori')){  //判断文件存在
            //验证图片大小
            foreach ($_FILES as $pic) {
                if ($pic['size'] > $this->uploadSizeLimit) {
                    echo "<script>alert(\"对不起，你上传的图片过大，请重新选择\");history.go(-1);</script>";exit;
                }
            }
            $file = $request->file('url_ori');  //获取文件
            $data['url_ori'] = \App\Tools::upload($file);
        }
        if (!$data['url_ori']) {
            echo "<script>alert('对不起，您还没上传图片！');history.go(-1);</script>";exit;
        }
        $pic = [
            'name'=> $data['name'],
            'url'=> $data['url_ori'],
            'intro'=> $data['intro'],
        ];
        return $pic;
    }
}