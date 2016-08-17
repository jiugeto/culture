<?php
namespace App\Http\Controllers\Person;

use App\Models\PicModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Hash;

class UserController extends BaseController
{
    /**
     * 个人后台 用户管理
     */

    protected $curr = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.user.index', $result);
    }

    public function getHead()
    {
        $result = [
            'user'=> $this->user,
            'pics'=> PicModel::where('uid',$this->userid)->get(),
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.user.edithead', $result);
    }

    public function setHead($picid)
    {
        UserModel::where('id',$this->userid)->update(array('head'=> $picid));
        return redirect(DOMAIN.'person/user');
    }

    public function edit()
    {
        $result = [
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.user.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        UserModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'person/user');
    }

    public function getPwd()
    {
        $result = [
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.user.editpwd', $result);
    }

    public function setPwd(Request $request,$id)
    {
        if (!$request->oldpwd || !$request->newpwd) {
            echo "<script>alert('2密码不能空！');history.go(-1);</script>";exit;
        }
        $userModel = UserModel::find($id);
        //验证密码正确否
        if (!(Hash::check($request->oldpwd,$userModel->password))) {
            echo "<script>alert('老密码错误！');history.go(-1);</script>";exit;
        }
        //查看2次密码输入是否一致
        if ($request->oldpwd!=$request->oldpwd2) {
            echo "<script>alert('2次老密码输入不一致！');history.go(-1);</script>";exit;
        }
        $data = array('password'=> Hash::make($request->newpwd), 'pwd'=>$request->newpwd);
        UserModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'person/user');
    }





    public function getData(Request $request)
    {
        if (!$request->username) { echo "<script>alert('用户名必填！');history.go(-1);</script>";exit; }
        if (strlen($request->username)<2 || strlen($request->username)>20) {
            echo "<script>alert('用户名要求2-20个字符！');history.go(-1);</script>";exit;
        }
        return array(
            'username'=> $request->username,
            'qq'=> $request->qq,
            'tel'=> $request->tel,
            'mobile'=> $request->mobile,
            'area'=> $request->area,
            'address'=> $request->address,
        );
    }
}