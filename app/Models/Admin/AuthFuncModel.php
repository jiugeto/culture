<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AuthFuncModel extends Model
{
    protected $table = 'bs_auth_func';
    protected $fillable = [
        'level_id','func_id','created_at','updated_at',
    ];
}