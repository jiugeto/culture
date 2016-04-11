<?php
namespace App\Http\Controllers\Admin;

use App\Models\CompanyModel;
use App\Models\PersonModel;
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
        $userModel = UserModel::find($id);
        if (in_array($userModel->isuser,[1,3])) {
            $personModel = PersonModel::where('uid',$id)->first();
        } elseif(in_array($userModel->isuser,[2,4,5,6])) {
            $companyModel = CompanyModel::where('uid',$id)->first();
        }
        $result = [
            'data'=> $userModel,
            'personModel'=> isset($personModel) ? $personModel : '',
            'companyModel'=> isset($companyModel) ? $companyModel : '',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.user.show', $result);
    }

    public function query()
    {
        return UserModel::orderBy('id','desc')->paginate($this->limit);
    }
}