<?php
namespace App\Models;

use App\Models\Base\PicModel;

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
        $pic_id = $this->pic_id ? $this->pic_id : 0;
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel : '';
    }

    public function getPicUrl()
    {
        return $this->pic() ? $this->pic()->url : '';
    }
}