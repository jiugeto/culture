<?php
namespace App\Models\Company;

use App\Models\BaseModel;
use App\Models\PicModel;

class ComFunctionsModel extends BaseModel
{
    /**
     * 企业主表 model
     */

    protected $table = 'bs_com_functions';
    protected $fillable = [
        'id','name','detail','title','intro','small','pic_id','isdefault','created_at','updated_at',
    ];

    public function pics()
    {
        return count(PicModel::all()) ? PicModel::all() : [];
    }

    public function pic()
    {
        return $this->pic_id ? PicModel::find($this->pic_id) : '';
    }
}