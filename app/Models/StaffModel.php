<?php
namespace App\Models;

class StaffModel extends BaseModel
{
    protected $table = 'bs_staffs';
    protected $fillable = [
        'id','name','genre','sex','realname','origin','education','school','hobby',
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

    /**
     * 人员公司的所有图片
     */
    public function getPics()
    {
        $staff_id = $this->id ? $this->id : 0;
        return StaffPicModel::where('staff_id',$staff_id)->get();
    }

    /**
     * 所在公司信息
     */
    public function getCompany()
    {
        $uid = $this->uid ? $this->uid : 0;
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $companyModel : '';
    }

    /**
     * 所在公司名称
     */
    public function getCompanyName()
    {
        return $this->getCompany() ? $this->getCompany()->name : '';
    }
}