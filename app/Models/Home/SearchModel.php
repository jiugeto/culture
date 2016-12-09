<?php
namespace App\Models\Home;

use App\Models\CompanyModel;
use App\Models\RentModel;
use App\Models\StaffModel;

class SearchModel extends \App\Models\BaseModel
{
    /**
     * 搜索表
     */

    protected $table = 'bs_search';
    protected $fillable = [
        'id','keyword','genre','fromid','created_at','updated_at',
    ];

    //检索条件：1创作，2样片，3创意，4分镜，5企业，6影视，7演员，8设备，9设计，
    protected $genres = [
        1=>'创作','样片','创意','分镜',/*'企业',*/6=>'影视','演员','设备','设计',
    ];

    /**
     * 获取热门词汇
     */
    public static function getHotWords()
    {
        return SearchKeywordModel::orderBy('rate','desc')->paginate(5);
    }

    /**
     * 将对这些表的操作，插入或更新到数据库
     * genre==1创作，2样片，3创意，4分镜，5企业，6影视，7演员，8设备，9设计，
     */
    public static function change($data,$genre,$oper)
    {
        $model = new SearchModel();
        if ($oper=='create') {
            if ($genre=='product') {
                $keyword = $data->name.$data->uname;
                SearchModel::intoDB($keyword,1,$data->id);
            } elseif ($genre=='goods') {
                $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
                SearchModel::intoDB($keyword,2,$data->id);
            } elseif ($genre=='idea') {
                $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
                SearchModel::intoDB($keyword,3,$data->id);
            } elseif ($genre=='storyboard') {
                $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
                SearchModel::intoDB($keyword,4,$data->id);
            } elseif ($genre=='company') {
                $companyModel = new CompanyModel();
                $genreName = array_key_exists($data->genre,$companyModel['genres']) ? $companyModel['genres'][$data->genre] : '';
                $keyword = $data->name.$data->uname.$genreName.
                    $companyModel->getAreaName($data->area).$data->address;
                SearchModel::intoDB($keyword,5,$data->id);
            } elseif ($genre=='works') {
                $keyword = $data->name.$model['cates2'][$data->cate];
                SearchModel::intoDB($keyword,6,$data->id);
            } elseif ($genre=='actor') {
                $education = new StaffModel();
                $keyword = $data->name.$data->realname.$data->origin.
                    $education['educations'][$data->education].$data->school.$education->getAreaName($data->area);
                SearchModel::intoDB($keyword,7,$data->id);
            } elseif ($genre=='rent') {
                $rentModel = new RentModel();
                $keyword = $data->name.$rentModel->getAreaName($data->area).$data->money.'元';
                SearchModel::intoDB($keyword,8,$data->id);
            } elseif ($genre=='design') {
                $keyword = $data->name.$model['cates1'][$data->cate].$data->money.'元';
                SearchModel::intoDB($keyword,9,$data->id);
            }
        } elseif ($oper=='update') {
            if ($genre=='product') {
                $keyword = $data->name.$data->uname;
                SearchModel::updateDB($keyword,1,$data->id);
            } elseif ($genre=='goods') {
                $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
                SearchModel::updateDB($keyword,2,$data->id);
            } elseif ($genre=='idea') {
                $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
                SearchModel::updateDB($keyword,3,$data->id);
            } elseif ($genre=='storyboard') {
                $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
                SearchModel::updateDB($keyword,4,$data->id);
            } elseif ($genre=='company') {
                $companyModel = new CompanyModel();
                $keyword = $data->name.$data->uname.$companyModel['genres'][$data->genre].
                    $companyModel->getAreaName($data->area).$data->address;
                SearchModel::updateDB($keyword,5,$data->id);
            } elseif ($genre=='works') {
                $keyword = $data->name.$model['cates2'][$data->cate];
                SearchModel::updateDB($keyword,6,$data->id);
            } elseif ($genre=='actor') {
                $education = new StaffModel();
                $keyword = $data->name.$data->realname.$data->origin.$education['educations'][$data->education].$data->school.$education->getAreaName($data->area);
                SearchModel::updateDB($keyword,7,$data->id);
            } elseif ($genre=='rent') {
                $rentModel = new RentModel();
                $keyword = $data->name.$rentModel->getAreaName($data->area).$data->money.'元';
                SearchModel::updateDB($keyword,8,$data->id);
            } elseif ($genre=='design') {
                $keyword = $data->name.$model['cates1'][$data->cate].$data->money.'元';
                SearchModel::updateDB($keyword,9,$data->id);
            }
        } elseif ($oper=='del') {
        }
    }

    /**
     * 增加查询的记录
     */
    public static function intoDB($keyword,$genre,$fromid)
    {
        $data = [
            'keyword'=> $keyword,
            'genre'=> $genre,
            'fromid'=> $fromid,
            'created_at'=> time(),
        ];
        SearchModel::create($data);
    }

    /**
     * 更新查询的记录
     */
    public static function updateDB($keyword,$genre,$fromid)
    {
        $data = [
            'keyword'=> $keyword,
            'genre'=> $genre,
            'fromid'=> $fromid,
            'updated_at'=> time(),
        ];
        SearchModel::where('fromid',$fromid)->update($data);
    }
}