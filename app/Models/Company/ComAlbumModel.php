<?php
namespace App\Models\Company;

use App\Models\BaseModel;

class ComAlbumsModel extends BaseModel
{
    /**
     * 企业主表 model
     */

    protected $table = 'bs_com_albums';
    protected $fillable = [
        'id','cid','type','pic_id','created_at',
    ];
    //图片类型：1公司产品，2合作单位，3服务图片，4广告，5其他
    protected $types = [
        1=>'公司产品','合作单位','服务图片','广告','其他',
    ];
}