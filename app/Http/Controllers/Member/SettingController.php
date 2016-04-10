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

//    type：1普通用户，2普通企业，3设计师，4广告公司，5影视公司，6租赁公司

    public function __construct()
    {
        if ($this->uid) { return redirect('/login'); }

        $this->model = new UserModel();
        $this->lists['func']['name'] = '用户设置';
        $this->lists['func']['url'] = 'setting';
        $this->uid = \Session::has('user.uid');
    }

    public function show()
    {
        $result = [
            'data'=> UserModel::find($this->uid),
            'lists'=> $this->lists,
            'curr_list'=> '',
            'menus'=> $this->menus,
        ];
        return view('member.setting.show', $result);
    }

    public function auth($id)
    {
        $result = [
            'data'=> UserModel::find($this->uid),
            'lists'=> $this->lists,
            'curr_list'=> '',
            'menus'=> $this->menus,
            'isusers'=> $this->model['isusers'],
        ];
        return view('member.setting.auth', $result);
    }

    /**
     * 资料更新
     */
    public function update(Request $request,$id)
    {
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
        UserModel::where('id',$id)->update($data);
        return redirect('/member/setting/'.$id);
    }

    /**
     * 修改密码
     */
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

    /**
     * 更新密码
     */
    public function updatepwd(Request $request,$id)
    {
        $userModel = UserModel::find($id);
        if (!Hash::check($userModel->password,$request->password)) {
            echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
        }
        if ($request->password!=$request->password2) {
            echo "<script>alert('2次密码不一致！');history.go(-1);</script>";exit;
        }
        UserModel::where('i d',$id)->update(['password'=> $request->password]);
        return redirect('/member/setting/'.$id);
    }
}