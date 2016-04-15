<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\VersionlogModel;

class UserlogController extends BaseController
{
    /**
     * 用户日志管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '版本日志';
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

    public function query()
    {
        return VersionlogModel::orderBy('id','desc')->paginate($this->limit);
    }
}