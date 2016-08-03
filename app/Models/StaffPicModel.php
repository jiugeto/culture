<?php
namespace App\Models;

class StaffPicModel extends BaseModel
{
    protected $table = 'bs_staff_pic';
    protected $fillable = [
        'id','staff_id','pic_id','created_at','updated_at',
    ];

    /**
     * 关联演员
     */
    public function actor()
    {
        return $this->hasOne('App\Models\ActorModel', 'id', 'actor_id');
    }

    /**
     * 关联图片
     */
    public function pic()
    {
        return $this->hasOne('App\Models\PicModel', 'id', 'pic_id');
    }
}