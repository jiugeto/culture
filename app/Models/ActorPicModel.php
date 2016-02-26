<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class ActorPicModel extends BaseModel
{
    protected $table = 'bs_actor_pic';
    protected $fillable = [
        'id','actor_id','pic_id','created_at',
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