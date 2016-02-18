<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\VideoCategoryModel;

class VideoCategoryController extends BaseController
{
    /**
     * 系统后台视频管理
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
            'name'=> '视频类型管理',
            'url'=> 'videocate',
        ],
    ];

    public function __construct()
    {
        $this->model = new VideoCategoryModel();
    }

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '视频类型列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/videocate',
        ];
        return view('admin.videoCate.index', $result);
    }

    public function create()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '视频类型添加';
        $crumb['function']['url'] = 'videocate/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'pcates'=> VideoCategoryModel::where('pid', 0)->get(),      //暂时父级pid==0
            'types'=> $this->model->getTypes(),
        ];
        return view('admin.videoCate.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        return redirect('/admin/videocate');
    }

    public function edit($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '视频类型修改';
        $crumb['function']['url'] = 'videocate/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> VideoCategoryModel::find($id),
        ];
        return view('admin.videoCate,edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        VideoCategoryModel::where('id',$id)->update($data);
        return redirect('/admin/videocate');
    }

    public function show($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '视频类型详情';
        $crumb['function']['url'] = 'videocate/show';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> VideoCategoryModel::find($id),
        ];
        return view('admin.videoCate.show', $result);
    }





    /**
     * =================
     * 一下是公用方法
     * =================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        $video = [
            'name'=> $data['name'],
            'pid'=> $data['pid'],
            'intro'=> $data['intro'],
        ];
        return $video;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        return VideoCategoryModel::paginate($this->limit);
    }
}