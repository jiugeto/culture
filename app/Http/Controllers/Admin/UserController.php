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
        $this->model = new UserModel();
        $this->crumb['']['name'] = '会员列表';
        $this->crumb['category']['name'] = '会员管理';
        $this->crumb['category']['url'] = 'user';
    }

    public function index($data='-')
    {
        $data = explode('-',$data);
        $isuser = $data[0];
        $isauth = $data[1];
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($isuser,$isauth),
            'crumb'=> $this->crumb,
            'prefix_url'=> '/admin/user',
            'curr'=> $curr,
            'isusers'=> $this->model['isusers'],
            'isuser'=> $isuser,
            'isauths'=> $this->model['isauths'],
            'isauth'=> $isauth,
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





    /**
     * 通过认证 isauth==2
     */
    public function toauth($id)
    {
        UserModel::where('id',$id)->update(['isauth'=>3]);
        return redirect('/admin/user');
    }
    /**
     * 拒绝通过认证 isauth==1
     */
    public function noauth($id)
    {
        UserModel::where('id',$id)->update(['isauth'=>2]);
        return redirect('/admin/user');
    }

    public function query($isuser,$isauth)
    {
        if ($isuser=='') {
            if ($isauth=='') {
                $datas = UserModel::orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = UserModel::orderBy('id','desc')
                    ->where('isauth',$isauth)
                    ->paginate($this->limit);
            }
        } else {
            if ($isauth=='') {
                $datas = UserModel::where('isuser',$isuser)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = UserModel::where('isuser',$isuser)
                    ->where('isauth',$isauth)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        }
        return $datas;
    }
}