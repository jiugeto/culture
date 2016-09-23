<?php
namespace App\Http\Controllers\Admin;

use App\Models\Base\PicModel;
use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductConModel;
use App\Models\Online\ProductModel;
use Illuminate\Http\Request;

class ProCreationController extends BaseController
{
    /**
     * 系统后台实时创作窗口
     */

    protected $prefix_url = 'attr_';
    protected $attrModel;

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '实时创作';
        $this->crumb['category']['name'] = '产品管理';
        $this->crumb['category']['url'] = 'product';
        $this->model = new ProductModel();
        $this->attrModel = new ProductAttrModel();
    }

    public function index($productid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
//            'datas'=> $this->getAttrs($productid),
            'product'=> ProductModel::find($productid),
            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'currUrl'=> 'play',
        ];
        return view('admin.proCreation.index', $result);
    }

    /**
     * 总编辑窗口
     */
    public function edit($productid,$con_id=0,$genre=1)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'product'=> ProductModel::find($productid),
            'cons'=> $this->getCons($productid),
            'content'=> $this->getOneCon($productid,$con_id),
            'attr'=> $this->getOneAttr($productid,$con_id,$genre),
            'attrModel'=> $this->attrModel,
            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'currUrl'=> 'edit',
        ];
        return view('admin.proCreation.index', $result);
    }

    /**
     * 新内容添加
     */
    public function insertCon(Request $request,$productid)
    {
        //一些限制
        if ($request->genre==1 && !$request->pic) {
            echo "<script>alert('图片必选！');history.go(-1);</script>";exit;
        }
        if ($request->genre==2 && !$request->text) {
            echo "<script>alert('文字必填！');history.go(-1);</script>";exit;
        }
        dd('000');

        //添加一个默认属性样式记录
        $attr = [
            'name'=> '',
            'style_name'=> $this->prefix_url.$productid.'_'.rand(0,1000),
            'genre'=> 1,        //图层默认第一层
            'padding'=> '',     //边框默认无
            'size'=> '100,100',     //默认宽高100*100
            'pos'=> '0,,',      //定位默认无
            'float'=> 0,        //浮动默认无
            'opacity'=> '0,0',      //默认无
            'created_at'=> time(),
        ];
        ProductAttrModel::create($attr);

        //增加内容记录
        $attrModel = ProductAttrModel::where($attr)->first();
        $data = [
            'productid'=> $request->productid,
            'attrid'=> $attrModel->id,
            'genre'=> $request->genre,
            'pic_id'=> $request->pic,
            'name'=> $request->text,
            'created_at'=> time(),
        ];
        ProductConModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/creation/editCon');
    }

    /**
     * 内容修改，这里id是con_id
     */
    public function updateCon(Request $request,$productid,$id)
    {
        dd('111',$request->all());
    }






    public function play($productid)
    {
        $urls = explode('/',$_SERVER['REQUEST_URI']);
        return view('admin.proCreation.basic.play', array(
            'currUrl'=> $urls[count($urls)-1],
        ));
    }

    public function play2($productid)
    {
        $urls = explode('/',$_SERVER['REQUEST_URI']);
        return view('admin.proCreation.basic.edit', array(
            'currUrl'=> $urls[count($urls)-1],
        ));
    }

    public function getAttrs($productid)
    {
        return ProductAttrModel::where('productid',$productid)->get();
    }

    public function getCons($productid)
    {
        return ProductConModel::where('productid',$productid)
            ->orderBy('id','desc')
            ->get();
    }

    public function getOneCon($productid,$con_id)
    {
        if ($con_id==0) {
            $data = ProductConModel::where('productid',$productid)
                ->orderBy('id','asc')
                ->first();
        } else {
            $data = ProductConModel::find($con_id);
        }
        return $data;
    }

    /**
     * 获取第一级属性
     */
    public function getOneAttr($productid,$con_id,$genre)
    {
        $con = $this->getOneCon($productid,$con_id);
        if ($genre==1) {
            $attr = ProductAttrModel::where('productid',$productid)
                ->where('parent',0)
                ->where('genre',$genre)
                ->first();
        } else {
            $attr = ProductAttrModel::where('productid',$productid)
            ->where('parent',$con->attrid)
            ->where('genre',$genre)
            ->first();
        }
        return $attr;
    }
}