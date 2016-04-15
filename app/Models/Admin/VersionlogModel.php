<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class VersionlogModel extends BaseModel
{
    /**
     * 这是用户日志表model
     */

    protected $table = 'ba_versions';
    protected $fillable = [
        'id','name','intro','created_at','updated_at',
    ];
}