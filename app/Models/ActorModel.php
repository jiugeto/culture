<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ActorModel extends BaseModel
{
    protected $table = 'bs_actors';
    protected $fillable = [
        'id','name','sex','realname','origin','education','school','hobby',
        'area','height','sort','isshow','del','created_at','updated_at',
    ];

    protected $educations = [
        1=>'小学及以下','初中','高中','大学','研究生','博士','其他',
    ];
    protected $hobbys = [
        1=>'旅游','象棋','运动','看书','K歌','上网','交友','听歌','看电影','钓鱼','画画',
    ];

    public function getHobby()
    {
        $hobby = $this->hobby ? $this->hobby : '';
        return $hobby ? explode(',',$hobby) : [];
    }

    public function getHobbyName()
    {
        if ($hobbys = $this->getHobby()) {
            foreach ($hobbys as $hobby) {
                $hobbyName = $this->hobbys[$hobby];
                $hobbyArr[] = $hobbyName;
            }
        }
        return isset($hobbyArr) ? implode('，',$hobbyArr) : '';  //此处是中文的逗号
    }
}