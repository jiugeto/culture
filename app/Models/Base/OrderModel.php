<?php
namespace App\Models\Base;

use App\Models\GoodsModel;
use App\Models\IdeasModel;
use App\Models\StoryBoardModel;

class OrderModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_orders';
    protected $fillable = [
        'id','name','serial','genre','fromid','seller','sellerName','buyer','buyerName','status','remarks','isshow','del','created_at','updated_at',
    ];

    protected $genreNames = [
        //1创意供应，2创意需求，3分镜供应，4分镜需求，5视频供应，6视频需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求
        1=>'创意供应',2=>'创意需求',3=>'分镜供应',4=>'分镜需求',5=>'视频供应',6=>'视频需求',
        7=>'娱乐供应',8=>'娱乐需求',9=>'演员供应',10=>'演员需求',11=>'租赁供应',12=>'租赁需求',
    ];

    //创意订单状态：1申请创意，2拒绝创意，3确定创意，4创意免费，5创意收费，6办理订单，7确认收到，12订单成功，13订单失败
    //分镜订单状态：1申请分镜，2拒绝分镜，3确定分镜，4分镜免费，5分镜收费，6办理订单，7确认收到，12订单成功，13订单失败
    //视频制作订单状态：1新的样片，2拒绝制作，3确认制作，4分期收费，5效果协商，6二期收费，7确定成片，8三期收费，9出片交付，10尾款结清，11确认完成，12订单成功，13订单失败
    //创意、分镜订单流程
    protected $status1s = [1=>'新的订单','拒绝订单','确认订单','订单免费','订单收费','办理订单','确认收到',12=>'订单成功','订单失败'];
    //视频订单流程
    protected $status2s = [
        1=>'新的片源','拒绝制作','确认制作','分期收费','效果协商','二期收费','确定成片','三期收费','出片交付','结清尾款','确认完成','订单成功','订单失败'
    ];
    //前台订单流程
    protected $status3s = [1=>'下订单',2=>'确定订单',3=>'拒绝订单',4=>'进行协商',6=>'办理订单',7=>'确认收到',12=>'办理成功',13=>'办理失败'];

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genreNames) ? $this->genreNames[$this->genre] : '';
    }

    public function statusName()
    {
        if (in_array($this->genre,[1,2,3,4])) {
            $status = array_key_exists($this->status,$this->status1s)?$this->status1s[$this->status]:'';
        } elseif (in_array($this->genre,[5,6])) {
            $status = array_key_exists($this->status,$this->status2s)?$this->status2s[$this->status]:'';
        } elseif (in_array($this->genre,[7,8,9,10,11,12])) {
            $status = array_key_exists($this->status,$this->status3s)?$this->status3s[$this->status]:'';
        }
        return isset($status) ? $status : '无';
    }

    public function statusbtn()
    {
        if (in_array($this->genre,[1,2,3,4])) {
            $status = array_key_exists($this->status+1,$this->status1s)?$this->status1s[$this->status+1]:'';
        } elseif (in_array($this->genre,[5,6])) {
            $status = array_key_exists($this->status+1,$this->status2s)?$this->status2s[$this->status+1]:'';
        } elseif (in_array($this->genre,[7,8,9,10,11,12])) {
            $status = array_key_exists($this->status+1,$this->status3s)?$this->status3s[$this->status+1]:'';
        }
        return isset($status) ? $status : '';
    }

    /**
     * 订单来源的数据
     */
    public function getModel()
    {
        if (in_array($this->genre,[1,2])) { $model = IdeasModel::find($this->fromid); }
        elseif (in_array($this->genre,[3,4])) { $model = StoryBoardModel::find($this->fromid); }
        elseif (in_array($this->genre,[5,6])) { $model = GoodsModel::find($this->fromid); }
        return isset($model) ? $model : '';
    }

    //以下是支付类方法

    /**
     * 获取对应支付信息
     */
    public function getPay()
    {
        $payModel = PayModel::where('genre',1)
            ->where('order_id',$this->id)
            ->first();
        return $payModel ? $payModel : '';
    }

    /**
     * 获取对应支付信息，视频专用
     */
    public function getPays()
    {
        $payModel = PayModel::where('genre',1)
            ->where('order_id',$this->id)
            ->orderBy('id','asc')
            ->get();
        return $payModel ? $payModel : [];
    }

    /**
     * 获取对应支付金额
     */
    public function getMoney($i=null)
    {
        if (in_array($this->genre,[5,6])) {
            $pay = $this->getPays();
            return (isset($pay[$i])&&$pay[$i]) ? $pay->money() : '';
        } else {
            return $this->getPay() ? $this->getPay()->money() : '';
        }
    }

    /**
     * 得到付款时间1
     */
    public function getCreateTime($i=null)
    {
        if (in_array($this->genre,[5,6])) {
            $pay = $this->getPays();
            return (isset($pay[$i])&&$pay[$i]) ? date('Y年m月d日 H:i',$pay->created_at) : '';
        } else {
            return $this->getPay() ? date('Y年m月d日 H:i',$this->getPay()->created_at) : '';
        }
    }

    /**
     * 得到付款来源表类型
     */
    public function getPayGenreName($i=null)
    {
        if (in_array($this->genre,[5,6])) {
            $pay = $this->getPays();
            return (isset($pay[$i])&&$pay[$i]) ? $pay->getGenreName() : '';
        } else {
            return $this->getPay() ? $this->getPay()->getGenreName() : '';
        }
    }

    /**
     * 得到付款的延时赔付
     */
    public function getPayFine($i=null)
    {
        if (in_array($this->genre,[5,6])) {
            $pay = $this->getPays();
            return (isset($pay[$i])&&$pay[$i]) ? $pay->getFineName() : '';
        } else {
            return $this->getPay() ? $this->getPay()->getFineName() : '';
        }
    }

    /**
     * 得到付款的支付宝确认状态码
     */
    public function getPayStatus($i=null)
    {
        if (in_array($this->genre,[5,6])) {
            $pay = $this->getPays();
            return (isset($pay[$i])&&$pay[$i]) ? $pay->ispay : 0;
        } else {
            return $this->getPay() ? $this->getPay()->ispay : 0;
        }
    }

    /**
     * 得到付款的支付宝确认状态值
     */
    public function getPayName($i=null)
    {
        if (in_array($this->genre,[5,6])) {
            $pay = $this->getPays();
            return (isset($pay[$i])&&$pay[$i]) ? $pay->getPayName() : '';
        } else {
            return $this->getPay() ? $this->getPay()->getPayName() : '';
        }
    }
}