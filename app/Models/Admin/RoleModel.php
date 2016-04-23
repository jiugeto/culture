<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class RoleModel extends BaseModel
{
    protected $table = 'ba_role';
    protected $fillable = [
        'id','name','intro','created_at','updated_at',
    ];

    public function admin()
    {
        return AdminModel::where('role_id',$this->id)->get();
    }

    public function action()
    {
        return RoleActionModel::where('role',\Session::get('admin.adminid'))->get();
    }
}