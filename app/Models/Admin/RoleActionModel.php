<?php
namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class RoleActionModel extends BaseModel
{
    protected $table = 'ba_role_action';
    protected $fillable = [
        'role_id','action_id','created_at','updated_at',
    ];
}