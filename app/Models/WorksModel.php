<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class WorksModel extends BaseModel
{
    /**
     * 影视作品（包含电视剧、电影、广告等等）
     */

    protected $table = 'bs_works';
    protected $fillable = [
        'id','name','cateid','intro','detail','video_id','pic_id','sort','isshow','del','created_at','updated_at',
    ];

//    protected $cates = [
//        //1电视剧，2电影，3微电影，4广告，5宣传片，6汇报片，7纪录片，
//        1=>'电视剧','电影','微电影','广告','宣传片','汇报片','纪录片',
//    ];

    public function cate()
    {
        return in_array($this->cateid,$this->cates) ? $this->cates[$this->cateid] : '无';
    }

    public function videos()
    {
        return VideoModel::all();
    }

    public function video()
    {
        $videoid = $this->videoid ? $this->videoid : 0;
        $videoModel = VideoModel::find($videoid);
        return $videoModel ? $videoModel : '无';
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
}