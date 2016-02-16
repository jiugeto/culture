<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\VideoModel;
use App\Models\VideoCategoryModel;

class VideoController extends BaseController
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
            'name'=> '视频管理',
            'url'=> 'video',
        ],
    ];

    public function __construct()
    {
        $this->model = new VideoModel();
    }

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '视频列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query(0),
            'cate'=> $this->model->cate(),
            'prefix_url'=> '/admin/video',
        ];
        return view('admin.video.index', $result);
    }

    public function create()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '视频添加';
        $crumb['function']['url'] = 'video/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'cates'=> VideoCategoryModel::all(),
        ];
       return view('admin.video.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        return redirect('/admin/video');
    }

    public function edit($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '视频修改';
        $crumb['function']['url'] = 'video/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'cates'=> VideoCategoryModel::all(),
            'data'=> VideoModel::find($id),
        ];
        return view('admin.video,edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        VideoModel::where('id',$id)->update($data);
        return redirect('/admin/video');
    }

    public function show($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '视频详情';
        $crumb['function']['url'] = 'video/show';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> VideoModel::find($id),
        ];
        return view('admin.video.show', $result);
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
            'intro'=> $data['intro'],
            'link'=> $data['link'],
            'uid'=> $data['uid'],
        ];
        return $video;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $videos = VideoModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        return $videos;
    }
}