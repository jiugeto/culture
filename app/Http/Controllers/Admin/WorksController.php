<?php
namespace App\Http\Controllers\Admin;

use App\Models\ActorWorksModel;
use Illuminate\Http\Request;
use App\Models\WorksModel;

class WorksController extends BaseController
{
    /**
     * 系统后台 影视作品（包含电视剧、电影、广告等等）
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new WorksModel();
        $this->crumb['']['name'] = '作品列表';
        $this->crumb['category']['name'] = '用户作品';
        $this->crumb['category']['url'] = 'works';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/works',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.works.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.works.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s',time());
        WorksModel::create($data);
        //更新作品演员关联表
        $actorWorksModel = WorksModel::where($data)->first();
        $this->updateActorWorks($request,$actorWorksModel->id);
        return redirect('/admin/works');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> WorksModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.works.edit', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> WorksModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.works.show', $result);
    }

    public function sort($id,$sort)
    {
        WorksModel::where('id',$id)->update(['sort'=> $sort]);
        return redirect('/admin/works');
    }

    public function destroy($id)
    {
        WorksModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/admin/works');
    }

    public function restore($id)
    {
        WorksModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/admin/works');
    }

    public function forceDelete($id)
    {
        WorksModel::where('id',$id)->delete();
        return redirect('/admin/works');
    }





    /**
     * 查询方法
     */
    public function query()
    {
        return WorksModel::orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->actor) { echo "<script>alert('请选择演员！');history.go(-1);</script>";exit; }
        return array(
            'name'=> $request->name,
            'cateid'=> $request->cateid,
            'intro'=> $request->intro,
        );
    }

    /**
     * 更新作品与演员的关联表
     */
    public function updateActorWorks(Request $request,$id)
    {
        $actorWorksModels = ActorWorksModel::where('worksid')->get();
        if (count($actorWorksModels)) {
            foreach ($actorWorksModels as $actorWorksModel) {
                $actorids[] = $actorWorksModel->actorid;        //已有的actorid集合
                //删除未选择的老记录
                if (!in_array($actorWorksModel->actorid,$request->actor)) {
                    ActorWorksModel::where('id',$actorWorksModel->id)->delete();
                }
                //更新已选择的记录
                if (in_array($actorWorksModel->actorid,$request->actor)) {
                    $update = array('actorid'=>$actorWorksModel->id,'updated_at'=>date('Y-m-d H:i:s',time()));
                    ActorWorksModel::where('id',$actorWorksModel->id)->update($update);
                }
            }
        }
        //增加新的记录
        if (!isset($actorids)) {
            foreach ($request->actor as $actorid) {
                $create = array('actorid'=>$actorid,'worksid'=>$id,'created_at'=>date('Y-m-d H:i:s',time()));
                ActorWorksModel::create($create);
            }
        }
        if (isset($actorids)) {
            foreach ($request->actor as $actorid) {
                if (in_array($request->actor,$actorids)) {
                    $create = array('actorid'=>$actorid,'worksid'=>$id,'created_at'=>date('Y-m-d H:i:s',time()));
                    ActorWorksModel::create($create);
                }
            }
        }
    }
}