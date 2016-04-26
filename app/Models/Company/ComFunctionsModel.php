<?php
namespace App\Models\Company;

use App\Models\BaseModel;

class ComFunctionsModel extends BaseModel
{
    /**
     * 企业主表 model
     */

    protected $table = 'bs_com_functions';
    protected $fillable = [
        'id','name','intro','created_at','updated_at',
    ];
}