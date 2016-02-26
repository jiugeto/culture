<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class RentPicModel extends BaseModel
{
    protected $table = 'bs_rent_pic';
    protected $fillable = [
        'id','rent_id','pic_id','created_at',
    ];

    /**
     * 关联租赁
     */
    public function rent()
    {
        return $this->hasOne('App\Models\RentModel', 'id', 'rent_id');
    }

    /**
     * 关联图片
     */
    public function pic()
    {
        return $this->hasOne('App\Models\PicModel', 'id', 'pic_id');
    }
}