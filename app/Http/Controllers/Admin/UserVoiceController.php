<?php
namespace App\Http\Controllers\Admin;

use App\Models\UserVoiceModel;

class UserVoiceController extends BaseController
{
    /**
     * 系统后台用户心声管理
     */

    public function __construct()
    {
        $this->crumb['']['name'] = '用户心声';
        $this->crumb['category']['name'] = '心声管理';
        $this->crumb['category']['url'] = 'uservoice';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'crumb'=> $this->crumb,
            'prefix_url'=> '/admin/uservoice',
            'curr'=> $curr,
        ];
        return view('admin.uservoice.index', $result);
    }





    /**
     * 查询方法
     */
    public function query($isshow=null)
    {
        return UserVoiceModel::where('isshow',$isshow)->paginate($this->limit);
    }
}