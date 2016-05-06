<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComMainModel;
use Illuminate\Http\Request;

class BasicController extends BaseController
{
    /**
     * 企业后台基本设置
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '基本设置';
        $this->lists['func']['url'] = 'basic';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'data'=> ComMainModel::where('cid',$this->cid)->first(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.basic.index', $result);
    }

    public function edit()
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComMainModel::where('cid',$this->cid)->first(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.basic.edit', $result);
    }

    public function update(Request $request,$id)
    {
        //图片上传处理
        if($request->hasFile('url_ori')){  //判断文件存在
            //验证图片大小
            foreach ($_FILES as $pic) {
                if ($pic['size'] > $this->uploadSizeLimit) {
                    echo "<script>alert(\"对不起，你上传的图片过大，请重新选择\");history.go(-1);</script>";exit;
                }
            }
            $file = $request->file('url_ori');  //获取文件
            $logo = \App\Tools::upload($file);
        }
        $data = [
            'logo'=> isset($logo) ? $logo : '',
            'title'=> $request->title,
            'keyword'=> $request->keyword,
            'description'=> $request->description,
            'updated_at'=> date('Y-m-d H:i:s', time()),
        ];
        //同时删除原有的logo图片
        $mainModel = ComMainModel::find($id);
        if (isset($logo) && $mainModel->logo && $mainModel->logo!=$this->sefLogo) {
            unlink(ltrim($mainModel->logo,'/'));
        }
        ComMainModel::where('id',$id)->update($data);
        return redirect('/company/admin/basic');
    }
}