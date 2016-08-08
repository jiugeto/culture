<?php
namespace App\Http\Controllers\Member;

use App\Models\UserModel;
use App\Models\PersonModel;
use App\Models\CompanyModel;
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
        parent::__construct();
        if ($this->userid) { return redirect('/login'); }
        $this->model = new UserModel();
        $this->lists['func']['name'] = '用户设置';
        $this->lists['func']['url'] = 'setting';
    }

    public function show()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $data = UserModel::find($this->userid);
        if (in_array($data->isuser,[1,3])) {
            $personModel = PersonModel::where('uid',$this->userid)->first();
        }
        if(in_array($data->isuser,[2,4,5,6])) {
            $companyModel = CompanyModel::where('uid',$this->userid)->first();
        }
        $result = [
            'data'=> $data,
            'personModel'=> isset($personModel) ? $personModel : '',
            'companyModel'=> isset($companyModel) ? $companyModel : '',
            'lists'=> $this->lists,
            'curr_list'=> '',
            'curr'=> $curr,
        ];
        return view('member.setting.show', $result);
    }

    public function auth($id)
    {
        $this->model = new UserModel();
        $result = [
            'data'=> UserModel::find($id),
            'lists'=> $this->lists,
            'curr_list'=> '',
            'isusers'=> $this->model['isusers'],
        ];
        return view('member.setting.auth', $result);
    }

    /**
     * 资料更新
     */
    public function update(Request $request,$id)
    {
        //基本信息
        if (!$request->isuser) {
            echo "<script>alert('用户类型必选！');history.go(-1);</script>";exit;
        }
        $user = [
            'email'=> $request->email,
            'qq'=> $request->qq,
            'tel'=> $request->tel,
            'mobile'=> $request->mobile,
            'isuser'=> $request->isuser,
            'isauth'=> 1,       //1是认证中
        ];
        UserModel::where('id',$id)->update($user);

        if (in_array($request->isuser,[1,3])) {
            //个人信息
            if (!$request->realname) {
                echo "<script>alert('真实名字必填！');history.go(-1);</script>";exit;
            }
            if (!$request->idcard) {
                echo "<script>alert('身份证号码必填！');history.go(-1);</script>";exit;
            }
            $person = [
                'realname'=> $request->realname,
                'sex'=> $request->sex,
                'idcard'=> $request->idcard,
                'uid'=> $id,
                'created_at'=> time(),
            ];
            PersonModel::create($person);
        } else {
            //公司信息
            $company = [
                'name'=> $request->name,
                'area'=> $request->area,
                'address'=> $request->address,
                'yyzzid'=> $request->yyzzid,
                'uid'=> $id,
                'created_at'=> time(),
            ];
            CompanyModel::create($company);
        }
        return redirect('/member/setting');
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
        ];
        return view('member.setting.pwd', $result);
    }

    /**
     * 更新密码
     */
    public function updatepwd(Request $request,$id)
    {
        $userModel = UserModel::find($id);
        if (!Hash::check($request->password,$userModel->password)) {
            echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
        }
        if (!$request->password2) {
            echo "<script>alert('新密码必填！');history.go(-1);</script>";exit;
        }
        UserModel::where('id',$id)->update(['password'=> Hash::make($request->password2)]);
        return redirect('/member/setting');
    }

    /**
     * 参数修改
     */
    public function info($id)
    {
        $result = [
            'data'=> UserModel::find($id),
            'lists'=> $this->lists,
            'curr_list'=> '',
        ];
        return view('member.setting.info', $result);
    }

    /**
     * 参数更新
     */
    public function updateinfo(Request $request,$id)
    {
        UserModel::where('id',$id)->update(['limit'=> $request->limit]);
        return redirect('/member/setting');
    }
}