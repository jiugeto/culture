<?php
namespace App\Http\Controllers\Admin;

use App\Models\UserModel;

class UserController extends BaseController
{
    /**
     * 用户日志管理
     */

    public function __construct()
    {
        $this->crumb['']['name'] = '会员列表';
        $this->crumb['category']['name'] = '会员管理';
        $this->crumb['category']['url'] = 'user';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'crumb'=> $this->crumb,
            'prefix_url'=> '/admin/user',
            'curr'=> $curr,
        ];
        return view('admin.user.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> UserModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.userlog.show', $result);
    }

    public function query()
    {
        return UserModel::orderBy('id','desc')->paginate($this->limit);
    }
}