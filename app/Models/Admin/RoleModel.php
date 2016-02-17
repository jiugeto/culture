<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'ba_role';
    protected $fillable = [
        'name','password','created_at','updated_at',
    ];
}