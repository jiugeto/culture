<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LinkModel;

class LinkController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new LinkModel();
        $this->crumb['']['name'] = '链接列表';
        $this->crumb['category']['name'] = '链接管理';
        $this->crumb['category']['url'] = 'link';
        $this->crumb['prefix'] = '链接';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'types'=> $this->model->type(),
            'datas'=> LinkModel::paginate($this->limit),
            'prefix_url'=> '/admin/link',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'plinks'=> LinkModel::where('pid',0)->get(),      //得到父链接
//            'types'=> $this->model->type(),
            'types'=> $this->model['types'],
            'pics'=> $this->model->pic(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        LinkModel::create($data);
        return redirect('/admin/link');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result =[
//            'actions'=> $this->actions(),
            'plinks'=> LinkModel::where('pid',0)->get(),      //得到父链接
//            'types'=> $this->model->type(),
            'pics'=> $this->model->pic(),
            'types'=> $this->model['types'],
            'data'=> LinkModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        LinkModel::where('id',$id)->update($data);
        return redirect('/admin/link');
    }

    public function show($id)
    {
        $data = LinkModel::find($id);
//        $data['type'] = $this->model->type();
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'data'=> $data,
            'types'=> $this->model['types'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.show', $result);
    }





    /**
     * ==========================
     * 一下是公用方法
     * ==========================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        if (!$data['title']) { $data['title'] = ''; }
        if (!$data['intro']) { $data['intro'] = ''; }
//        //获取图片文件名
//        $data['url_ori'] = '';
//        if($request->hasFile('url_ori')){  //判断文件存在
//            //验证图片大小
//            foreach ($_FILES as $pic) {
//                if ($pic['size'] > $this->uploadSizeLimit) {
//                    echo "<script>alert(\"对不起，你上传的图片过大，请重新选择\");history.go(-1);</script>";exit;
//                }
//            }
//            $file = $request->file('url_ori');  //获取文件
//            $data['url_ori'] = $this->upload($file);
//        }
        //pic为0时，display_way不能为2
//        if (!$data['url_ori'] && $data['display_way']==2) {
//            echo "<script>alert(\"对不起，您未上传图片，不能以图片方式显示在前台，请重新选择\");history.go(-1);</script>";exit;
//        }
        $data = [
            'name'=> $data['name'],
            'title'=> $data['title'],
            'type_id'=> $data['type_id'],
//            'pic'=> $data['url_ori'],
            'intro'=> $data['intro'],
            'link'=> $data['link'],
            'display_way'=> $data['display_way'],
            'isshow'=> $data['isshow'],
            'pid'=> $data['pid'],
        ];
        return $data;
    }
}