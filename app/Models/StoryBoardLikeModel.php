<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class StoryBoardLikeModel extends BaseModel
{
    /**
     * 分镜模型
     */
    protected $table = 'bs_storyboards_like';
    protected $fillable = [
        'id','uid','sbid','created_at',
    ];
}