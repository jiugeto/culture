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
        parent::__construct();
        $this->model = new VideoModel();
        $this->crumb['']['name'] = '视频列表';
        $this->crumb['category']['name'] = '视频管理';
        $this->crumb['category']['url'] = 'video';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'datas'=> $this->query(0),
            'cate'=> $this->model->cate(),
            'prefix_url'=> '/admin/video',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.video.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'cates'=> VideoCategoryModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
       return view('admin.video.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        return redirect('/admin/video');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'cates'=> VideoCategoryModel::all(),
            'data'=> VideoModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.video,edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        VideoModel::where('id',$id)->update($data);
        return redirect('/admin/video');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> VideoModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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