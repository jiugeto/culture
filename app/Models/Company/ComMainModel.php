<?php
namespace App\Models\Company;

use App\Models\BaseModel;

class ComMainModel extends BaseModel
{
    /**
     * 企业主表 model
     */

    protected $table = 'com_main';
    protected $fillable = [
        'id','uid','cid','name','title','keyword','description','logo','job','job_num','job_require','sort','istop','isshow','isshow2','created_at','updated_at',
    ];

    public function company()
    {
        return \App\Models\CompanyModel::find($this->cid);
    }
}