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
}