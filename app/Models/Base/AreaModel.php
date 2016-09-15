<?php
namespace App\Models\Base;

class AreaModel extends BaseModel
{
    protected $table = 'bs_citys';
    protected $fillable = [
        'id','parentid','cityname','nocode','zipcode','weathercode','created_at','updated_at',
    ];

    /**
     * 上级地区的名称
     */
    public function parent()
    {
        return $this->parentid ? AreaModel::find($this->parentid)->cityname : '0级';
    }
}