<?php
namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class AdminModel extends BaseModel
{
    protected $table = 'ba_admin';
    protected $fillable = [
        'id','username','realname','password','pwd','role_id','intro','created_at','updated_at',
    ];

    public function role()
    {
        $roleid = $this->role_id ? $this->role_id : 0;
        $roleModel = RoleModel::find($roleid);
        return $roleModel ? $roleModel->name : '';
    }
}