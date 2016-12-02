<?php
namespace App\Models;

use App\Models\Base\PicModel;

class UserParamsModel extends BaseModel
{
    /**
     * 这是用户参数表 model
     */

    protected $table = 'users_params';
    protected $fillable = [
        'id','uid','limit','foot_switch','lecloud','lepwd','leplay','per_top_bg_img','created_at','updated_at',
    ];

    public function getTopBg()
    {
        $pic_id = $this->per_top_bg_img ? $this->top_bg_img : 0;
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel->url : '';
    }

    public function pics($uid)
    {
        return PicModel::where('uid',$uid)->get();
    }

    public function getPicUrl()
    {
        $picModel = PicModel::find($this->per_top_bg_img);
        return $picModel ? $picModel->url : '';
    }
}