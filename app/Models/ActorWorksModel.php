<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class ActorWorksModel extends BaseModel
{
    /**
     * 演员和影视作品（包含电视剧、电影、广告等等）关联表
     */

    protected $table = 'bs_actor_works';
    protected $fillable = [
        'id','actorid','worksid','created_at','updated_at',
    ];
}