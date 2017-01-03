<?php
namespace App\Models;

use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiSign;
use App\Api\ApiUser\ApiUsers;
use App\Models\Base\AreaModel;
use App\Models\Base\PicModel;
use App\Models\Company\ComMainModel;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $timestamps = false;

    //支持 DesignModel
    //类型：房产，效果图，平面，漫游
    protected $cates1 = [
        1=>'房产漫游','效果图','平面设计',
    ];

    //支持 IdeasModel、StoryBoardModel、GoodsModel、WorksModel
    //样片类型：1电视剧，2电影，3微电影，4广告，5宣传片，6专题片，7汇报片，8主题片，9纪录片，10晚会，11淘宝视频，12婚纱摄影，13个人短片，
    protected $cates2 = [
        1=>'电视剧','电影','微电影','广告','宣传片','专题片','汇报片','主题片','纪录片','晚会','淘宝视频','婚纱摄影','个人短片',
    ];

    //支持 OrderModel、OrdersFirmModel、OrdersProdustModel
    //视频格式：网络版640*480，标清720*576，小高清1280*720，高清1920*1080，
    protected $formats = [
        1=>'640*480','720*576','1280*720','1920*1080',
    ];
    protected $formatNames = [
        1=>'网络版','标清','小高清','高清',
    ];

    /**
     * 创建时间转换
     */
    public function createTime()
    {
        return $this->created_at ? date("Y年m月d日 H:i", $this->created_at) : '';
    }

    /**
     * 更新时间转换
     */
    public function updateTime()
    {
        return $this->updated_at ? date("Y年m月d日 H:i", $this->updated_at) : '未更新';
    }

    /**
     * 拼接地区名称字符串
     */
    public function getAreaName($area=null)
    {
        $areaid = $this->area ? $this->area : 0;
        if (!$areaid && $area) { $areaid = $area; }
        $areaModel = AreaModel::find($areaid);
        $areaName = '';
        //本级
        if ($areaModel) {
            $areaName = $areaName ? $areaName.','.$areaModel->cityname : $areaModel->cityname;
        }
        //上一级
        if ($areaModel&&$areaModel->parentid) {
            $areaModel2 = AreaModel::find($areaModel->parentid);
            $areaName = $areaModel2 ? $areaName.','.$areaModel2->cityname : $areaName;
        }
        //上上级
        if (isset($areaModel2)&&$areaModel2->parentid) {
            $areaModel3 = AreaModel::find($areaModel2->parentid);
            $areaName = $areaModel3 ? $areaName.','.$areaModel3->cityname : $areaName;
        }
        return $areaName;
    }

    public function isshow()
    {
        return $this->isshow==1 ? '前台显示' : '前台不显示';
    }

    /**
     * 由uid得到 用户信息
     */
    public function getUser($uid=null)
    {
        $rstUser = ApiUsers::getOneUser($uid);
        return $rstUser['code']==0 ? $rstUser['data'] : [];
    }

    public function getUserName($uid=null)
    {
        $userid = $uid ? $uid : $this->uid;
       return $this->getUser($userid) ? $this->getUser($userid)['username'] : '';
    }

    /**
     * 由uid得到 公司信息
     */
    public function getCompany($uid=null)
    {
        $rstCompany = ApiCompany::getOneCompany($uid);
        return $rstCompany['code']==0 ? $rstCompany['data'] : [];
    }

    public function getCompanyMain($uid=null)
    {
        $comMainInfo = ComMainModel::where('uid',$uid)->first();
        return $comMainInfo ? $comMainInfo : '';
    }

    public function getCompanyName($uid=null)
    {
        return $this->getCompany($uid) ? $this->getCompany($uid)['name'] : '';
    }

    /**
     * 价格：bs_storyboard，bs_designs，bs_goods，bs_ideas，bs_rents，bs_staffs，
     */
    public function money()
    {
        return $this->money ? $this->money.'元' : '';
    }

//    /**
//     * 获得某个会员的所有图片
//     */
//    public function getUserPics($uid=null)
//    {
//        if ($uid) {
//            $datas = PicModel::where('uid',$uid)->get();
//        } else {
//            $datas = PicModel::all();
//        }
//        return $datas;
//    }

//    /**
//     * 获取用户图片尺寸：高度$w，确定宽度$h
//     */
//    public function getUserPicSize($picModel,$w,$h)
//    {
//        $pic = $picModel;
//        if ($pic && $pic->width && $pic->height) {
//            $ratio1 = $w / $h;
//            $ratio2 = $pic->width / $pic->height;
//            if ($ratio1>$ratio2) {
//                $size['w'] = $w;
//                $size['h'] = $pic->width / $ratio1;
//            } else {
//                $size['w'] = $h * $ratio2;
//                $size['h'] = $h;
//            }
//        }
//        return (isset($size)&&$size) ? $size : [];
//    }

//    /**
//     * 通过 picid 获取图片链接
//     */
//    public function getUrlByPicid($picid)
//    {
//        $picModel = PicModel::find($picid);
//        return $picModel ? $picModel->getUrl() : '';
//    }

//    /**
//     * 通过 picid、width、height 获取图片尺寸
//     */
//    public function getImgSize($picid,$w,$h)
//    {
//        $picModel = PicModel::find($picid);
//        if ($picModel && $picModel->width && $picModel->height) {
//            $size = $this->getUserPicSize($picModel,$w,$h);
//        }
//        return (isset($size)&&$size) ? $size : [];
//    }

    /**
     * 用户签到状态的方法
     * 当前用户签到状态
     */
    public function getSignStatus($uid,$dateStr)
    {
        $dateArr = explode('-',$dateStr);
        $day = strlen($dateArr[2])==1?'0'.$dateArr[2]:$dateArr['2'];
        $date = $dateArr[0].$dateArr[1].$day;
        $dayCurr = date('Ymd',time());

        $fromtime = $date.'000000';      //凌晨0点
        $totime = $date.'240000';      //夜里24点
        $rstSigns = ApiSign::getSignsByUid($uid,$fromtime,$totime);

        if ($date<$dayCurr) {
            //过去的签到状态
            if ($rstSigns['code']==0) {
                $status['code'] = 1;
                $status['name'] = '已签到';
            } else {
                $status['code'] = 2;
                $status['name'] = '未签到';
            }
        } elseif ($date>=$dayCurr) {
            //当天、未来签到状态
            if ($rstSigns['code']==0) {
                $status['code'] = 3;
                $status['name'] = '已签到';
            } else {
                $status['code'] = 4;
                $status['name'] = '待签到';
            }
        } else {
            $status['code'] = 0;
            $status['name'] = '签到';
        }
        return $status;
    }

    /**
     * 获取用户图片尺寸：高度$w，确定宽度$h
     */
    public function getImgSize($img,$w=0,$h=0)
    {
        if (!$img) {
            dd('没有图片！');
        } elseif (!in_array(mb_substr($img,0,4),['/upl','http'])) {
            dd('图片地址有误！');
        } elseif (substr($img,0,4)=='http') {
            //假设是外网图片链接
            $imgInfo = getimagesize($img);
        } else {
            $imgInfo = getimagesize(ltrim($img,'/'));
        }
//        dd(getimagesize(ltrim($img,'/')));
        if (!$w || !$h) {
            $size['w'] = $imgInfo[0];
            $size['h'] = $imgInfo[1];
        } elseif ($imgInfo[0] && $imgInfo[1]) {
            $width = $imgInfo[0];
            $height = $imgInfo[1];
            $ratio1 = $w / $h;
            $ratio2 = $width / $height;
            if ($w>$h && $width>$height && $ratio1>$ratio2) {
                $size['w'] = $w;
                $size['h'] = $w * $ratio2;
            } elseif ($w>$h && $width>$height && $ratio1<=$ratio2) {
                $size['w'] = $h * $ratio2;
                $size['h'] = $h;
            } elseif ($w>$h && $width<$height && $ratio1>$ratio2) {
                $size['w'] = $w;
                $size['h'] = $w / $ratio2;
            } elseif ($w<$h && $width>$height && $ratio1<$ratio2) {
                $size['w'] = $h;
                $size['h'] = $h / $ratio2;
            } elseif ($w<$h && $width<$height && $ratio1>$ratio2) {
                $size['w'] = $w;
                $size['h'] = $w * $ratio2;
            } elseif ($w<$h && $width<$height && $ratio1<=$ratio2) {
                $size['w'] = $h * $ratio2;
                $size['h'] = $h;
            }
        }
        return (isset($size)&&$size) ? $size : [];
    }
}