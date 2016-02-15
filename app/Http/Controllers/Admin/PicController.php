<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PicModel;

class PicController extends BaseController
{
    /**
     * 图片管理
     */

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '图片管理',
            'url'=> 'pic',
        ],
    ];

    public function __construct()
    {
        $this->model = new PicModel();
    }

    public function index()
    {
        $actions = $this->actions();
        $datas = PicModel::paginate($this->limit);
        $types = $this->model->type();
        $crumb = $this->crumb;
        $crumb['function']['name'] = '图片列表';
        $crumb['function']['url'] = '';
        $prefix_url = '/admin/pic';
        return view('admin.pic.index', compact(
            'actions','datas','types','crumb','prefix_url'
        ));
    }

    public function create($type_id=0)
    {
        $actions = $this->actions();
        $types = $this->model->type();
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加';
        $crumb['function']['url'] = 'pic/create';
        return view('admin.pic.create', compact(
            'actions','types','crumb','type_id'
        ));
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        PicModel::create($data);
        return redirect('/admin/pic');
    }

    public function edit($id)
    {
        $actions = $this->actions();
        $data = PicModel::find($id);
        $types = $this->model->type();
        $crumb = $this->crumb;
        $crumb['function']['name'] = '修改';
        $crumb['function']['url'] = 'pic/edit';
        return view('admin.pic.edit', compact(
            'actions','data','types','crumb'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        PicModel::where('id',$id)->update($data);
        return redirect('/admin/pic');
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
            $data['url_ori'] = $this->upload($file);
        }
        if (!$data['url_ori']) {
            echo "<script>alert('对不起，您还没上传图片！');history.go(-1);</script>";exit;
        }
        $pic = [
            'name'=> $data['name'],
            'type_id'=> $data['type_id'],
            'url'=> $data['url_ori'],
            'intro'=> $data['intro'],
        ];
        return $pic;
    }
}