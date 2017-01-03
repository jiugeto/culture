<?php
namespace App\Models;

class DesignPicModel extends BaseModel
{
    protected $table = 'bs_designs_img';
    protected $fillable = [
        'id','design_id','link','created_at','updated_at',
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
}