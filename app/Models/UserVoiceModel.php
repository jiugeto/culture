<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class UserVoiceModel extends BaseModel
{
    protected $table = 'bs_user_voice';
    protected $fillable = [
        'id','title','uid','content','isshow','created_at',
    ];

    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel->username : '无';
    }
}