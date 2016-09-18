<?php
namespace App\Models;

use App\Models\Base\PicModel;
use App\Models\Base\VideoModel;

class WorksModel extends BaseModel
{
    /**
     * 影视作品（包含电视剧、电影、广告等等）
     */

    protected $table = 'bs_works';
    protected $fillable = [
        'id','name','uid','cid','cate','intro','detail','video_id','pic_id','sort','isshow','del','created_at','updated_at',
    ];

    public function getCateName()
    {
        return array_key_exists($this->cate,$this->cates2) ? $this->cates2[$this->cate] : '';
    }

    public function videos()
    {
        return VideoModel::all();
    }

    public function video()
    {
        $videoid = $this->videoid ? $this->videoid : 0;
        $videoModel = VideoModel::find($videoid);
        return $videoModel ? $videoModel : '';
    }

    public function staffs()
    {
        return StaffModel::all();
    }

    public function staff()
    {
        $worksid = $this->id ? $this->id : 0;
        $staffWorks = StaffWorksModel::where('worksid',$worksid)->get();
        if (count($staffWorks)) {
            foreach ($staffWorks as $staffWork) {
                $staffids[] = $staffWork->staffid;
            }
        }
        return isset($staffids) ? StaffModel::whereIn('id',$staffids)->get() : [];
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
     * 发布人信息
     */
    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel : '';
    }

    /**
     * 得到大图url
     */
    public function getPicUrl()
    {
        $picModel = PicModel::find($this->pic_id);
        return $picModel ? $picModel->getUrl() : '';
    }

    /**
     * 得到该片演员
     */
    public function getActors()
    {
        $staffWorks = StaffWorksModel::where('works_id',$this->id)->get();
        $staffIds = array();
        if (count($staffWorks)) {
            foreach ($staffWorks as $staffWork) {
                $staffIds[] = $staffWork->id;
            }
        }
        $staffModels = StaffModel::whereIn('id',$staffIds)->get();
        return $staffModels ? $staffModels : [];
    }
}