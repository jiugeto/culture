<?php
namespace App\Http\Controllers\Admin;

use App\Models\UserlogModel;

class UserlogController extends BaseController
{
    /**
     * 用户日志管理
     */

    public function __construct()
    {
        $this->crumb['']['name'] = '用户日志';
        $this->crumb['category']['name'] = '用户日志管理';
        $this->crumb['category']['url'] = 'userlog';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'crumb'=> $this->crumb,
            'prefix_url'=> '/admin/userlog',
            'curr'=> $curr,
        ];
        return view('admin.userlog.index', $result);
    }

    public function query()
    {
        return UserlogModel::orderBy('id','desc')->paginate($this->limit);
    }
}