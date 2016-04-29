<?php
namespace App\Models;

class CompanyModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'companys';
    protected $fillable = [
        'id','name','area','address','yyzzid','uid','sort','areacode','tel','qq','web','fax','zipcode','email','created_at','updated_at',
    ];
}