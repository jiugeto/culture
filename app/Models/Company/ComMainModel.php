<?php
namespace App\Models\Company;

use App\Models\BaseModel;

class ComMainModel extends BaseModel
{
    /**
     * 企业主表 model
     */

    protected $table = 'bs_com_main';
    protected $fillable = [
        'id','uid','cid','cname','title','keyword','description','logo','job','sort','istop','isshow','isshow2','created_at','updated_at',
    ];
}