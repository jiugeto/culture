<?php
namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Models\TalksModel;

class TalkController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new TalksModel();
        $this->crumb['']['name'] = '话题列表';
        $this->crumb['category']['name'] = '话题管理';
        $this->crumb['category']['url'] = 'talk';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> TalksModel::paginate($this->limit),
            'prefix_url'=> '/admin/talk',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.talk.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> TalksModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.talk.show', $result);
    }
}