<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;
use App\Models\Base\PayModel;
use App\Models\Base\PicModel;
use App\Models\Base\VideoModel;

class OrderProductModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_orders_pro';
    protected $fillable = [
        'id','productid','serial','genre','uid','uname','seller','format','record','video_id','status','isshow','created_at','updated_at',
    ];
    protected $genres = [
        1=>'在线模板','离线模板','无模板',
    ];
    //视频格式
    protected $formatNames = [
        1=>'标清(720*405)','小高清(1280*720)','高清(1920*1080)',
    ];
    protected $formatMoneys = [
        1=>20,40,60,
    ];
    //订单状态：待定价，待打款，款不对，待处理，已处理
    protected $statuss = [
        '所有','待定价','待打款','未付款或款不对','已付款处理中','已处理',
    ];
    protected $isshows = [
        '所有','不显示','显示',
    ];

    public function getGenreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    /**
     * 买家名称
     */
    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    /**
     * 卖家名称
     */
    public function getSellerName()
    {
        return $this->getUserName($this->seller);
    }

    /**
     * 得到创作订单信息
     */
    public function getProduct()
    {
        $productModel = ProductModel::find($this->productid);
        return $productModel ? $productModel : '';
    }

    /**
     * 得到创作订单名称
     */
    public function getProductName()
    {
        return $this->getProduct() ? $this->getProduct()->name : '';
    }

    /**
     * 获取对应支付信息
     */
    public function getPay()
    {
        $payModel = PayModel::where('genre',3)
            ->where('order_id',$this->id)
            ->first();
        return $payModel ? $payModel : '';
    }

    /**
     * 获取对应支付金额
     */
    public function getMoney()
    {
        return $this->getPay() ? $this->getPay()->money() : '';
    }

    /**
     * 获取对应支付总金额
     */
    public function getWeal()
    {
        return $this->getPay() ? $this->getPay()->weal() : '';
    }

    /**
     * 获取对应支付总金额
     */
    public function getRealmoney()
    {
        return $this->getPay()->money - $this->getPay()->weal . '元';
    }

    /**
     * 渲染状态
     */
    public function getStatusName()
    {
        return array_key_exists($this->status,$this->statuss) ? $this->statuss[$this->status] : '';
    }

    /**
     * 渲染的格式
     */
    public function getFormatName()
    {
        return array_key_exists($this->format,$this->formatNames) ? $this->formatNames[$this->format] : '';
    }

    public function isshow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }

    /**
     * 获得视频信息
     */
    public function getVideo()
    {
        $videoModel = VideoModel::find($this->video_id);
        return $videoModel ? $videoModel : '';
    }

    /**
     * 获得所有图片名称
     */
    public function getPicName()
    {
        return $this->getVideo() ? $this->getVideo()->getPicName() : '';
    }

    /**
     * 获得所有图片名称
     */
    public function getPicUrl()
    {
        return $this->getVideo() ? $this->getVideo()->getPicUrl() : '';
    }
}