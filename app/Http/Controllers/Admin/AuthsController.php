<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiMenu;
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
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'menuModel' => $this->getAuthModel(),
            'auths0' => $this->getAuthsByUserType(0),
            'auths1' => $this->getAuthsByUserType(1),
            'auths2' => $this->getAuthsByUserType(2),
            'auths3' => $this->getAuthsByUserType(3),
            'auths4' => $this->getAuthsByUserType(4),
            'auths5' => $this->getAuthsByUserType(5),
            'auths6' => $this->getAuthsByUserType(6),
            'auths7' => $this->getAuthsByUserType(7),
            'auths8' => $this->getAuthsByUserType(50),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.auth.index', $result);
    }

    public function edit($auth)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        if ($menus=$this->getAuthsByUserType($auth)) {
            foreach ($menus as $menu) { $menuIds[] = $menu['menu']; }
        }
        $result = [
            'menusM' => $this->getMenus(1),
            'menusP' => $this->getMenus(2),
            'menusC' => $this->getMenus(3),
            'menuIds' => isset($menuIds) ? $menuIds : [],
            'crumb' => $this->crumb,
            'curr' => $curr,
            'auth' => $auth,
        ];
        return view('admin.auth.edit', $result);
    }

    /**
     * 设置权限
     */
    public function setAuth(Request $request,$auth)
    {
        if (!$request->menu) {
            echo "<script>alert('功能必选！');history.go(-1);</script>";exit;
        }
        $data = [
            'auth'  =>  $request->auth,
            'menu'  =>  $request->menu,
        ];
        $apiMenu = ApiMenu::setAuth($data);
        if ($apiMenu['code']!=0) {
            echo "<script>alert('".$apiMenu['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/auth');
    }






    /**
     * 获取权限 model
     */
    public function getAuthModel()
    {
        $apiModel = ApiMenu::getAuthModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }

    /**
     * 根据 usertype 获取权限
     */
    public function getAuthsByUserType($userType)
    {
        $apiAuth = ApiMenu::getAuthsByUserType($userType);
        return $apiAuth['code']==0 ? $apiAuth['data'] : [];
    }

    /**
     * 获取菜单列表
     */
    public function getMenus($userType=0)
    {
        $apiMenu = ApiMenu::getMenusByType($userType);
        return $apiMenu['code']==0 ? $apiMenu['data'] : [];
    }
}