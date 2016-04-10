<?php
namespace App\Models;

class CompanyModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'companys';
    protected $fillable = [
        'id','name','area','address','yyzzid','uid','created_at','updated_at',
    ];
}