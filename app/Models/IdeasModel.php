<?php
namespace App\Models;

class IdeasModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'bs_ideas';
    protected $fillable = [
        'id','name','cate_id','content','uid','read','click','created_at','updated_at',
    ];

    public function cate()
    {
        return $this->hasOne('\App\Models\CategoryModel','id','cate_id');
    }
}