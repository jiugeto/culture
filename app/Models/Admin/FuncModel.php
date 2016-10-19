<?php
namespace App\Models\Admin;

use App\Models\Base\BaseModel;

class FuncModel extends BaseModel
{
    protected $table = 'bs_funcs';
    protected $fillable = [
        'id','name','genre','table_name','intro','created_at','updated_at',
    ];
}