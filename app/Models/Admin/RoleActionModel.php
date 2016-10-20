<?php
namespace App\Models\Admin;

use App\Models\Base\BaseModel;

class RoleActionModel extends BaseModel
{
    protected $table = 'ba_role_action';
    protected $fillable = [
        'id','role_id','action_id','created_at','updated_at',
    ];
}