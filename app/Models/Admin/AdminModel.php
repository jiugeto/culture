<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'ba_admin';

    protected $fillable = [
        'id','name','password','role_id','created_at','updated_at',
    ];
}