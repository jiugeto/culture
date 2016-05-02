<?php
namespace App\Models\Company;

use App\Models\BaseModel;
use App\Models\CompanyModel;

class ComJobModel extends BaseModel
{
    /**
     * 公司后台控制中心：企业招聘表 model
     */

    protected $table = 'bs_com_jobs';
    protected $fillable = [
        'id','name','cid','intro','job','num','require','sort','sort2','istop','istop2','isshow','isshow2','del','created_at','updated_at',
    ];

    public function company()
    {
        return $this->cid ? CompanyModel::find($this->cid) : 0;
    }
}