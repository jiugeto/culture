<?php
namespace App\Models\Admin;

use App\Models\Base\BaseModel;

class AuthModel extends BaseModel
{
    protected $table = 'bs_menu_auths';
    protected $fillable = [
        'id','auth','menu','created_at','updated_at',
    ];
    //用户类型：0普通用户，1个人会员，2普通企业，3设计师，4广告公司，5影视公司，6租赁公司
    protected $auths = [
        '普通用户','个人会员','普通企业','设计师','广告公司','影视公司','租赁公司',
    ];

    /**
     * 获取权限名称
     */
    public function getAuthName()
    {
        return array_key_exists($this->auth,$this->auths) ? $this->auths[$this->auth] : '';
    }

    /**
     * 获取功能名称
     */
    public function getMenuName()
    {
        $menuModel = MenusModel::find($this->menu);
        return $menuModel ? $menuModel->name : '';
    }

    public function getMenus()
    {
        return MenusModel::orderBy('type','desc')->get();
    }

    public function getAuths($auth)
    {
        $authModel = AuthModel::where('auth',$auth)->get();
        return count($authModel) ? $authModel : '';
    }
}