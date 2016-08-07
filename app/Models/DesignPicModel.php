<?php
namespace App\Models;

class DesignPicModel extends BaseModel
{
    protected $table = 'bs_designs_pic';
    protected $fillable = [
        'id','design_id','pic_id','created_at','updated_at',
    ];

    /**
     * 关联娱乐
     */
    public function design()
    {
        $entertain_id = $this->entertain_id ? $this->entertain_id : 0;
        $entertainModel = EntertainModel::find($entertain_id);
        return $entertainModel ? $entertainModel : '';
    }

    public function getDesignName()
    {
        return $this->design() ? $this->design()->title : '';
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