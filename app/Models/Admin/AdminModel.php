<?php
namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class AdminModel extends BaseModel
{
    protected $table = 'ba_admin';
    protected $fillable = [
        'id','name','password','role_id','created_at','updated_at',
    ];
}