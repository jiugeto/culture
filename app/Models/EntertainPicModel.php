<?php
namespace App\Models;

class EntertainPicModel extends BaseModel
{
    protected $table = 'bs_entertain_pic';
    protected $fillable = [
        'id','entertain_id','pic_id','created_at',
    ];

    /**
     * 关联娱乐
     */
    public function entertain()
    {
        return $this->hasOne('App\Models\EntertainModel', 'id', 'entertain_id');
    }

    /**
     * 关联图片
     */
    public function pic()
    {
        return $this->hasOne('App\Models\PicModel', 'id', 'pic_id');
    }
}