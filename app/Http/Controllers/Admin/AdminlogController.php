<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminlogModel;

class AdminlogController extends BaseController
{
    /**
     * 用户日志管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '管理员日志';
        $this->crumb['category']['name'] = '管理员日志管理';
        $this->crumb['category']['url'] = 'adminlog';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'crumb'=> $this->crumb,
            'prefix_url'=> '/admin/adminlog',
            'curr'=> $curr,
        ];
        return view('admin.userlog.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> AdminlogModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.userlog.show', $result);
    }

    public function query()
    {
        $datas = AdminlogModel::orderBy('id','desc')->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}