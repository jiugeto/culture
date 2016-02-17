<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class FunctionModel extends Model
{
    protected $table = 'bs_functions';
    protected $fillable = [
        'name','intro','table_id','table_name','action','created_at','updated_at',
    ];
}