<?php
namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class AdminModel extends BaseModel
{
    protected $table = 'ba_admin';
    protected $fillable = [
        'id','username','realname','password','email','role_id','intro','created_at','updated_at',
    ];

    public function role()
    {
        if ($this->role_id) {
            return RoleModel::find($this->role_id)->name;
        } else {
            return '';
        }
    }
}