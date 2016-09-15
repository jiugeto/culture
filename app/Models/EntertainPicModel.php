<?php
namespace App\Models;

class EntertainPicModel extends BaseModel
{
    protected $table = 'bs_entertain_pic';
    protected $fillable = [
        'id','entertain_id','pic_id','created_at','updated_at',
    ];

    /**
     * 关联娱乐
     */
//    public function entertain()
//    {
//        return $this->hasOne('App\Models\EntertainModel', 'id', 'entertain_id');
//    }
    public function entertain()
    {
        $entertain_id = $this->entertain_id ? $this->entertain_id : 0;
        $entertainModel = EntertainModel::find($entertain_id);
        return $entertainModel ? $entertainModel : '';
    }

    public function getEntertainName()
    {
        return $this->entertain() ? $this->entertain()->title : '';
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