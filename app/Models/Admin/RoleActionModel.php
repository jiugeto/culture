<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoleActionModel extends Model
{
    protected $table = 'ba_role_action';
    protected $fillable = [
        'role_id','action_id','created_at','updated_at',
    ];
}