<?php
namespace App\Http\Controllers\Member;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Hash;

class SettingController extends BaseController
{
    /**
     *会员认证管理
     */

//    type：1普通用户，2普通企业，3设计师，4制作公司，5租赁公司，6娱乐公司

    public function __construct()
    {
        $this->model = new UserModel();
        $this->lists['func']['name'] = '用户设置';
        $this->lists['func']['url'] = 'setting';
        $this->uid = \Session::has('user.uid');
        if ($this->uid) { return redirect('/logon'); }
    }

    public function index()
    {
        $data = UserModel::find($this->uid);
        if ($data->email && $data->qq && $data->tel && $data->mobile && $data->isuser) {
            return redirect('/member/setting/'.$data->id);
        } else {
            $result = [
                'data'=> $data,
                'lists'=> $this->lists,
                'curr_list'=> '',
                'menus'=> $this->menus,
                'isusers'=> $this->model['isusers'],
            ];
            return view('member.setting.index', $result);
        }
    }

    public function update(Request $request,$id)
    {
        if ($request->submit=='basic') {
            if (!$request->isuser) {
                echo "<script>alert('用户类型必选！');history.go(-1);</script>";exit;
            }
            $data = [
                'email'=> $request->email,
                'qq'=> $request->qq,
                'tel'=> $request->tel,
                'mobile'=> $request->mobile,
                'isuser'=> $request->isuser,
            ];
        } elseif($request->submit=='pwd') {
            $userModel = UserModel::find($id);
            if (!Hash::check($userModel->password,$request->password)) {
                echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
            }
            if ($request->password!=$request->password2) {
                echo "<script>alert('2次密码不一致！');history.go(-1);</script>";exit;
            }
            $data['password'] = $request->password;
        }
        UserModel::where('id',$id)->update($data);
        return redirect('/member/setting/'.$id);
    }

    public function show($id)
    {
        $result = [
            'data'=> UserModel::find($id),
            'lists'=> $this->lists,
            'curr_list'=> '',
            'menus'=> $this->menus,
        ];
       return view('member.setting.show', $result);
    }

    public function pwd($id)
    {
        $result = [
            'data'=> UserModel::find($id),
            'lists'=> $this->lists,
            'curr_list'=> '',
            'menus'=> $this->menus,
        ];
        return view('member.setting.pwd', $result);
    }
}