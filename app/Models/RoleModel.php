<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class RoleModel extends BaseModel
{
    protected $table = 'ba_role';
    protected $fillable = [
        'id','name','password','admin_id','created_at','updated_at',
    ];
}