<?php
namespace App\Http\Controllers\Company\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company\ComMainModel;
use App\Models\CompanyModel;

class BaseController extends Controller
{
    /**
     * 公司后台控制中心基础控制器
     */

    public function __construct()
    {
        if (\Session::has('user.cid')) {
            $this->cid = \Session::get('user.cid');
//            $this->company['basic'] = CompanyModel::find($this->cid);
            $this->company['basic'] = unserialize(\Session::get('user.usercompany'));
        } else {
//            echo "<script>alert('你还木有做公司认证！');</script>";exit;
//            $this->userid = \Session::get('user.uid');
//            return redirect('/member/setting/'.$this->userid.'/auth');
        }
    }
}