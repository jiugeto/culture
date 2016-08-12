<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\VersionlogModel;
use Illuminate\Http\Request;

class VersionlogController extends BaseController
{
    /**
     * 版本管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '版本日志列表';
        $this->crumb['category']['name'] = '版本日志管理';
        $this->crumb['category']['url'] = 'versionlog';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'crumb'=> $this->crumb,
            'prefix_url'=> '/admin/versionlog',
            'curr'=> $curr,
        ];
        return view('admin.versionlog.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
       return view('admin.versionlog.create', $result);
    }

    public function store(Request $request)
    {
        if (!$request->intro) {
            echo "<script>alert('内容不能为空！');history.go(-1)</script>";exit;
        }
        $versionlog = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'created_at'=> time(),
        ];
        VersionlogModel::create($versionlog);
        return redirect('/admin/versionlog');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> VersionlogModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.versionlog.show', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> VersionlogModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.versionlog.edit', $result);
    }

    public function update(Request $request,$id)
    {
        if (!$request->intro) {
            echo "<script>alert('内容不能为空！');history.go(-1)</script>";exit;
        }
        $versionlog = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'updated_at'=> date('Y-m-d H:i:s', time()),
        ];
        VersionlogModel::where('id',$id)->update($versionlog);
        return redirect('/admin/versionlog');
    }

    public function forceDelete($id)
    {
        VersionlogModel::where('id',$id)->delete();
        return redirect('/admin/versionlog');
    }


    public function query()
    {
        $datas = VersionlogModel::orderBy('id','desc')->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}