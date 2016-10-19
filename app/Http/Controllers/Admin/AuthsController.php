<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\MenusModel;
use App\Models\Admin\AuthModel;
use Illuminate\Http\Request;

class AuthsController extends BaseController
{
    /**
     * 系统后台所有细分功能的权限控制统一管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '用户权限列表';
        $this->crumb['category']['name'] = '用户权限管理';
        $this->crumb['category']['url'] = 'auth';
        $this->model = new AuthModel();
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.auth.index', $result);
    }

    public function edit($auth)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'auth'=> $auth,
        ];
        return view('admin.auth.edit', $result);
    }

    /**
     * 设置权限
     */
    public function setAuth($auth,$menu)
    {
        $authModel = AuthModel::where('auth',$auth)->where('menu',$menu)->first();
        if ($authModel) {
            AuthModel::where('auth',$auth)->where('menu',$menu)->delete();
        } else {
            $this->insertDB($auth,$menu);
        }
        return redirect(DOMAIN.'admin/auth');
    }





    public function insertDB($auth,$menu)
    {
        $data = [
            'auth'=> $auth,
            'menu'=> $menu,
            'created_at'=> time(),
        ];
        AuthModel::create($data);
    }
}