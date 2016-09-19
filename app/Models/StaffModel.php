<?php
namespace App\Models;

use App\Models\Base\PicModel;

class StaffModel extends BaseModel
{
    protected $table = 'bs_staffs';
    protected $fillable = [
        'id','name','entertain_id','uid','genre','thumb','sex','realname','origin','education','school','hobby',
        'area','height','sort','isshow','del','created_at','updated_at',
    ];
    //1=>演员，导演，摄影师，灯光师，化妆师，21=>剪辑师，特效师，合成师，配音，背景音
    protected $genres = [
        1=>'演员','导演','摄影师','灯光师','化妆师',
        //中间预留给前期，21开始为后期
        21=>'剪辑师','特效师','合成师','配音','背景音',
    ];
    protected $educations = [
        1=>'小学及以下','初中','高中','大学','研究生','博士','其他',
    ];
    protected $hobbys = [
        1=>'旅游','象棋','运动','看书','K歌','上网','交友','听歌','看电影','钓鱼','画画',
    ];

    /**
     * 得到娱乐信息
     */
    public function entertain()
    {
        $entertain_id = $this->entertain_id ? $this->entertain_id : 0;
        $entertainModel = EntertainModel::find($entertain_id);
        return $entertainModel ? $entertainModel : '';
    }

    /**
     * 得到娱乐标题
     */
    public function getEntertainTitle()
    {
        return $this->entertain() ? $this->entertain()->title : '';
    }

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function sexName()
    {
        return $this->sex==1 ? '男' : '女';
    }

    public function eduName()
    {
        return array_key_exists($this->education,$this->educations) ? $this->educations[$this->education] : '';
    }

    /**
     * 发布人信息
     */
    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel : '';
    }

    /**
     * 公司信息
     */
    public function company()
    {
        $uid = $this->uid?$this->uid:0;
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $companyModel : '';
    }

    /**
     * 获得公司名称或用户名称
     */
    public function getUName()
    {
        $name = $this->company() ? $this->company()->name : '';
        if (!$name) {
            $name = $this->user() ? $this->user()->username : '';
        }
        return $name;
    }

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

    public function height()
    {
        return $this->height.'CM';
    }

    /**
     * 人员公司的所有图片
     */
    public function getPics()
    {
        $staff_id = $this->id ? $this->id : 0;
        return StaffPicModel::where('staff_id',$staff_id)->get();
    }

    /**
     * 获取图片
     */
    public function pic()
    {
        $pic_id = $this->thumb ? $this->thumb : 0;
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel : '';
    }

    /**
     * 获取图片url
     */
    public function getPicUrl()
    {
        return $this->pic() ? $this->pic()->getUrl() : '';
    }
}