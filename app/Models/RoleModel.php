<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'ba_role';
    public $timestamps = false;
    protected $fillable = [
        'id','name','password','admin_id','created_at','updated_at',
    ];
}