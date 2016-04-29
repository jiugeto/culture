<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\CompanyModel;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    /**
     * 企业开展后台，招聘管理
     */

    protected $curr_url = 'contact';

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '联系编辑';
        $this->lists['func']['url'] = 'contact';
    }

    public function index()
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> $this->query(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.contact.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $data = CompanyModel::find($id);
        if ($data->tel) {}
        $result = [
            'data'=> $data,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.contact.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = [
            'areacode'=> $request->areacode,
            'tel'=> $request->tel,
            'qq'=> $request->qq,
            'web'=> $request->web,
            'fax'=> $request->fax,
            'zipcode'=> $request->zipcode,
            'email'=> $request->email,
        ];
        CompanyModel::where('id',$id)->update($data);
        return redirect('/company/admin/contact');
    }





    public function query()
    {
        return CompanyModel::where('uid',$this->userid)->first();
    }
}