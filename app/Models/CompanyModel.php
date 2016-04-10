<?php
namespace App\Models;

class CompanyModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'companys';
    protected $fillable = [
        'id','name','genre','area','address','yyzzid','created_at','updated_at',
    ];

    protected $genres = [       //对应users表isuser
        2=>'普通企业',4=>'广告公司',5=>'影视公司',6=>'租赁公司',
    ];

    public function genre()
    {
        return $this->genres[$this->genre];
    }
}