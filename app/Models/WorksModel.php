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
        'id','name','cateid','intro','videoid','sort','isshow','del','created_at','updated_at',
    ];

    protected $cates = [
        //1电视剧，2电影，3微电影，4广告，5宣传片，6汇报片，7纪录片，
        1=>'电视剧','电影','微电影','广告','宣传片','汇报片','纪录片',
    ];

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
        return $videoModel ? $videoid : '';
    }

    public function actors()
    {
        return ActorModel::all();
    }
}