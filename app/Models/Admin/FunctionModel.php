<?php
namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class FunctionModel extends BaseModel
{
    protected $table = 'bs_functions';
    protected $fillable = [
        'name','intro','table_name','action','created_at','updated_at',
    ];
}