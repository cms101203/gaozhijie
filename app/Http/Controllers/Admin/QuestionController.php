<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Xm as XmModel;
use App\Models\Question as QuestionModel;
use App\Models\Questions as QuestionsModel;
use App\Models\Category as CateModel;
use App\Models\Region as RegionModel;
use App\Models\Picture as PictureModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
       
    protected $fields = [
        'title'=>"",
        'pt' => 25,
        'xid' => 0,
        'cate' => 0,
        'cates' => 0,
        'province' => 0,
        'city' => 0,
        'people' => 0,
        'author' => '',
        'summary' => '',
        'status' => 1,
        'content' => '',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = QuestionModel::count();
            if (trim($search['title']) || $search['id'] || $search['status'] != '' || $search['people'] || $search['cate'] || $search['cates'] || $search['province']|| $search['city'] || $search['pt']  || $search['xid'] || $search['author'] || $search['date'] ) {
                
                $data['recordsFiltered'] = QuestionModel::where(function ($query) use ($search) {
                            if (strlen($search['title']) > 0) {
                                $query->where('title', 'LIKE', '%' . trim($search['title']) . '%');
                            }
                            if (strlen($search['author']) > 0) {
                                $query->where('author', 'LIKE', '%' . trim($search['author']) . '%');
                            }
                            if ($search['id']) {
                                $query->where("id", '=', $search['id']);
                            }
                            if ($search['status'] != '') {
                                $query->where("status", '=', $search['status']);
                            }
                            if($search['people']){
                                $query->where('people','=',$search['people']);
                            }
                            if($search['cate']){
                                $query->where('cate','=',$search['cate']);
                            }
                            if($search['cates']){
                                $query->where('cates','=',$search['cates']);
                            }
                            if($search['pt']){
                                $query->whereRaw("find_in_set(?,`pt`)",array($search['pt']));
                            }
                            if($search['province']){
                                $query->where('province','=',$search['province']);
                            }
                            if($search['city']){
                                $query->where('city','=',$search['city']);
                            }
                            if($search['xid']){
                                $query->where('xid','=',$search['xid']);
                            }
                            if($search['date']){
                                $date = explode(' - ', $search['date']);
                                $query->where('created_at','>=',$date[0]);
                                $query->where('created_at','<=',$date[1]);
                            }
                        })->count();
                $data['data'] = QuestionModel::where(function ($query) use ($search) {
                                  if (strlen($search['title']) > 0) {
                                        $query->where('title', 'LIKE', '%' . trim($search['title']) . '%');
                                    }
                                    if ($search['id']) {
                                        $query->where("id", '=', $search['id']);
                                    }
                                    if ($search['status'] != '') {
                                        $query->where("status", '=', $search['status']);
                                    }
                                    if($search['people']){
                                        $query->where('people','=',$search['people']);
                                    }
                                    if($search['cate']){
                                        $query->where('cate','=',$search['cate']);
                                    }
                                    if($search['cates']){
                                        $query->where('cates','=',$search['cates']);
                                    }
                                    if($search['pt']){
                                        $query->whereRaw("find_in_set(?,`pt`)",array($search['pt']));
                                    }
                                    if($search['province']){
                                        $query->where('province','=',$search['province']);
                                    }
                                    if($search['city']){
                                        $query->where('city','=',$search['city']);
                                    }
                                    if($search['xid']){
                                        $query->where('xid','=',$search['xid']);
                                    }
                                    if($search['date']){
                                        $date = explode(' - ', $search['date']);
                                        $query->where('created_at','>=',$date[0]);
                                        $query->where('created_at','<=',$date[1]);
                                    }
                                })->skip($start)->take($length)
                                ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                                ->get()->toArray();
            } else {
                $data['recordsFiltered'] = QuestionModel::count();
                $data['data'] = QuestionModel::skip($start)->take($length)
                                ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                                ->get()->toArray();
            }
            if ($data['data']) {
                foreach ($data['data'] as $key => $value) {
                    
                    if($value['cate']){
                        $str = "";
                        $cate = CateModel::find($value['cate']);
                        $str.=$cate['name'];
                        if($value['cates']){
                            $cates = CateModel::find($value['cates']);
                            $str.="--".$cates['name'];
                        }
                        $data['data'][$key]['cate'] = $str;
                    }
                    if ($value['people']) {
                        $people = CateModel::find($value['people']);
                        $data['data'][$key]['people'] = $people['name'];
                    }
                    
                    if($value['province']){
                        $str = "";
                        $province = RegionModel::where('region_id','=',$value['province'])->first();
                        $str.=$province['region_name'];
                        if($value['city']){
                            $city = RegionModel::where('region_id','=',$value['city'])->first();
                            $str.="--".$city['region_name'];
                        }
                        $data['data'][$key]['area'] = $str;
                    }
                    
                    if($value['pt']){
                        $pt = CateModel::find($value['pt']);
                        $data['data'][$key]['pt'] = $pt['name'];
                    }
                    
                    if($value['xid']){
                        $xm = XmModel::find($value['xid']);
                        $data['data'][$key]['xid'] = $xm['name'];
                    }
                }
            }
            
            
            return response()->json($data);
        }
        //地区
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        $data['citylist'] = array();
        //行业分类
        $data['cateAll'] = CateModel::where('pid', '=', 11)->get()->toArray();
        $data['catesAll'] = array();
        //所属平台
        $data['ptAll'] = CateModel::where('pid', '=', 24)->get()->toArray();
        //项目等级
        $data['srAll'] = CateModel::where('pid', '=', 17)->get()->toArray();
        return view('admin.question.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=0) {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        $data['citylist'] = array();
        //栏目等级
        $data['columns'] = array();
        //行业分类
        $data['cateAll'] = CateModel::where('pid', '=', 11)->get()->toArray();
        $data['catesAll'] = array();
        //所属平台
        $data['ptAll'] = CateModel::where('pid', '=', 24)->get()->toArray();
        //适合人群
        $data['srAll'] = CateModel::where('pid', '=', 17)->get()->toArray();
        $data['logo'] = array();
        $data['colAll'] = array();
        $data['cid'] = $id;
        return view('admin.question.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $model = new QuestionModel();
        $models = new QuestionsModel();
        foreach (array_keys($this->fields) as $field) {
            if (!in_array($field, array('content'))) {
                $model->$field = $request->get($field);
            }else{
                if($request->get($field)){
                    $models->$field = htmlspecialchars($request->get($field));
                }
            }
        }
        if ($request->get('title') == '') {
            return redirect()->back()->withErrors('问答标题不能为空！');
        }
        if (empty($request->get('pt'))) {
            return redirect()->back()->withErrors('所属平台必须选！');
        }
        if (empty($request->get('xid'))) {
            return redirect()->back()->withErrors('项目ID不能为0！');
        }

        $model->created_at = date('Y-m-d H:i:s', time());
        $model->updated_at = date('Y-m-d H:i:s', time());
        $model->author = auth()->user()->name;
        $model->save();
        $id = $model->id;
        
        //答案
        if ($id) {
            $models->id = $id;
            $models->save();
        }

        return redirect('/admin/question')->withSuccess('添加成功！');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $xm = QuestionModel::find((int) $id)->toArray();
        
        if (!$xm)
            return redirect('/admin/question')->withErrors("找不到该问答!");
        $xmdetail = QuestionModel::find((int)$id)->getdetail->toArray();
        if(is_array($xm) && is_array($xmdetail)){
            $xm = array_merge($xm,$xmdetail);
        }
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $xm[$field]);
        }
        
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        $data['id'] = (int) $id;
        $data['citylist'] = RegionModel::where('pid', '=', $xm['province'])->get()->toArray();
        //行业分类
        $data['cateAll'] = CateModel::where('pid', '=', 11)->get()->toArray();
        $data['catesAll'] = array();
        if($xm['cate']){
            $data['catesAll'] = CateModel::where('pid', '=', $xm['cate'])->get()->toArray();
        }
        //所属平台
        $data['ptAll'] = CateModel::where('pid', '=', 24)->get()->toArray();
        //适合人群
        $data['srAll'] = CateModel::where('pid', '=', 17)->get()->toArray();
        
        return view('admin.question.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $xm = QuestionModel::find((int)$id);
        $xmdetail = QuestionsModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            if (!in_array($field, array('content'))) {
                $xm->$field = $request->get($field);
            }else{
                if($request->get($field)){
                    $xmdetail->$field = htmlspecialchars($request->get($field));
                }
            }
        }
        if ($request->get('title') == '') {
            return redirect()->back()->withErrors('问答标题不能为空！');
        }
        if (empty($request->get('pt'))) {
            return redirect()->back()->withErrors('所属平台必须选！');
        }
        if (empty($request->get('xid'))) {
            return redirect()->back()->withErrors('项目ID不能为0！');
        }
        $xm->updated_at = date('Y-m-d H:i:s', time());
        $xm->author = auth()->user()->name;
        $xm->save();
        //答案
        $xmdetail->save();

        return redirect('/admin/question')->withSuccess('修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $status = $request->get('status');
        $tag = QuestionModel::find((int) $id);
        if ($tag) {
            if($status){
                if($status==2){
                    $tag->status=0;
                }elseif($status==1){
                    $tag->status=1;
                }
                $tag->save();
            }else{
                $tags = QuestionsModel::find((int) $id);
                $tag->delete();
                if($tags){
                    $tags->delete();
                }
            }
        } else {
            return redirect()->back()->withErrors("操作失败");
        }

        return redirect()->back()->withSuccess("操作成功");
    }
}
