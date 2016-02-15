<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LinkModel;

class LinkController extends BaseController
{
    /**
     * 网站链接管理
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
            'name'=> '链接管理',
            'url'=> 'link',
        ],
        'prefix'=> '链接',
    ];

    public function __construct()
    {
        $this->model = new LinkModel();
    }

    public function index()
    {
        $actions = $this->actions();
        $datas = LinkModel::paginate($this->limit);
//        $types = $this->model['types'];
        $types = $this->model->type();
        $crumb = $this->crumb;
        $crumb['function']['name'] = '链接列表';
        $crumb['function']['url'] = '';
        $prefix_url = '/admin/link';
        return view('admin.link.index', compact(
            'actions','datas','types','crumb','prefix_url'
        ));
    }

    public function create()
    {
        $actions = $this->actions();
        $plinks = LinkModel::where('pid',0)->get();      //得到父链接
//        $types = $this->model['types'];
        $types = $this->model->type();
        $pics = $this->model->pic();
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加';
        $crumb['function']['url'] = 'link/create';
        return view('admin.link.create', compact(
            'actions','plinks','types','pics','crumb'
        ));
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
        $actions = $this->actions();
        $plinks = LinkModel::where('pid',0)->get();      //得到父链接
        $data = LinkModel::find($id);
        $types = $this->model->type();
        $pics = $this->model->pic();
        $crumb = $this->crumb;
        $crumb['function']['name'] = '修改';
        $crumb['function']['url'] = 'link/edit';
        return view('admin.link.edit', compact(
            'actions','plinks','data','types','pics','crumb'
        ));
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
        $data['type'] = $this->model->type();
        $crumb = $this->crumb;
        $crumb['function']['name'] = $crumb['prefix'].'详情';
        $crumb['function']['url'] = 'link/show';
        $result = [
            'actions'=> $this->actions(),
            'data'=> $data,
            'crumb'=> $crumb,
        ];
        dd($result);
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
        /*//获取图片文件名
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
        }*/
        //pic为0时，display_way不能为2
        if (!$data['url_ori'] && $data['display_way']==2) {
            echo "<script>alert(\"对不起，您未上传图片，不能以图片方式显示在前台，请重新选择\");history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $data['name'],
            'title'=> $data['title'],
            'type'=> $data['type'],
            'pic'=> $data['url_ori'],
            'intro'=> $data['intro'],
            'link'=> $data['link'],
            'display_way'=> $data['display_way'],
            'isshow'=> $data['isshow'],
            'pid'=> $data['pid'],
        ];
        return $data;
    }
}