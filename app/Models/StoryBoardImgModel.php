<?php
namespace App\Models;

class StoryBoardLikeModel extends BaseModel
{
    /**
     * 分镜图片
     */
    protected $table = 'bs_storyboard_img';
    protected $fillable = [
        'id','sbid','link','created_at',
    ];
}