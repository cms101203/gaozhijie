<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company as CompanyModel;
use App\Models\Category as CateModel;
use App\Models\Region as RegionModel;
use App\Models\Picture as PictureModel;
use App\Models\Xm as XmModel;
use App\Models\Xmdetail as Xmdetail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class XmController extends Controller
{
    
    protected $fields = [
        'cid'=>0,
        'name' => '',
        'pt' => '',
        'cate' => 0,
        'cates' => 0,
        'mktime' => '',
        'cradle' => '中国',
        'story' => '',
        'chopcode' => '',
        'firstime' => '',
        'directnum' => 0,
        'proxynum' => 0,
        'amount' => 0,
        'locat' => '',
        'crowd' => 0,
        'models' => 0,
        'zsarea' => 0,
        'grade' => 0,
        'score' => 0,
        'infee' => 0,
        'product' => '',
        'lights' => '',
        'slogan' => '',
        'status' => 1,
        'conditions' => '',
        'xmdesc' => '',
        'advantage'=>'',
        'policies'=>'',
        'analysis'=>'',
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
            $data['recordsTotal'] = XmModel::count();
            if (strlen($search['name']) > 0 || $search['id'] || $search['status'] != '' || $search['cname'] || $search['cate'] || $search['cates'] || $search['grade'] || $search['pt']) {
                $cidsarr = array();
               if($search['cname']){
                    $companynum = CompanyModel::where('name','LIKE','%'.$search['cname'].'%')->get();
                    
                    if($companynum){
                        $search['status'] = 2;
                    }else{
                        foreach($companynum as $v){
                            $cidsarr[] = $v['id'];
                        }
                    }
               }
                $data['recordsFiltered'] = XmModel::where(function ($query) use ($search) {
                            if (strlen($search['name']) > 0) {
                                $query->where('name', 'LIKE', '%' . $search['name'] . '%');
                            }
                            if ($search['id']) {
                                $query->where("id", '=', $search['id']);
                            }
                            if ($search['status'] != '') {
                                $query->where("status", '=', $search['status']);
                            }
                            if($search['grade']){
                                $query->where('grade','=',$search['grade']);
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
                            if(!empty($cidsarr)){
                                $query->whereIn('cid',$cidsarr);
                            }
                        })->count();
                $data['data'] = XmModel::where(function ($query) use ($search) {
                                   if (strlen($search['name']) > 0) {
                                        $query->where('name', 'LIKE', '%' . $search['name'] . '%');
                                    }
                                    if ($search['id']) {
                                        $query->where("id", '=', $search['id']);
                                    }
                                    if ($search['status'] != '') {
                                        $query->where("status", '=', $search['status']);
                                    }
                                    if($search['grade']){
                                        $query->where('grade','=',$search['grade']);
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
                                    if(!empty($cidsarr)){
                                        $query->whereIn('cid',$cidsarr);
                                    }
                                })->skip($start)->take($length)
                                ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                                ->get()->toArray();
            } else {
                $data['recordsFiltered'] = XmModel::count();
                $data['data'] = XmModel::skip($start)->take($length)
                                ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                                ->get()->toArray();
            }
            if ($data['data']) {
                foreach ($data['data'] as $key => $value) {
                    if ($value['cid']) {
                        $company = CompanyModel::find($value['cid']);
                        $data['data'][$key]['cid'] = $company['name'];
                    }
                    if($value['pt']){
                        $ptarr = explode(',', $value['pt']);
                        $ptstr = "";
                        foreach($ptarr as $v){
                            $cate = CateModel::find($v);
                            $ptstr .= $cate['name'].",";
                        }
                        $data['data'][$key]['pt'] = rtrim($ptstr,',');
                    }
                    if($value['grade']){
                        $grade = CateModel::find($value['grade']);
                        $data['data'][$key]['grade'] = $grade['name'];
                    }
                }
            }
            
            
            return response()->json($data);
        }
        //行业分类
        $data['cateAll'] = CateModel::where('pid', '=', 11)->get()->toArray();
        $data['catesAll'] = array();
        //所属平台
        $data['ptAll'] = CateModel::where('pid', '=', 24)->get()->toArray();
        //项目等级
        $data['gradeAll'] = CateModel::where('pid', '=', 18)->get()->toArray();
        return view('admin.xm.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        //项目等级
        $data['gradeAll'] = CateModel::where('pid', '=', 18)->get()->toArray();
        //行业分类
        $data['cateAll'] = CateModel::where('pid', '=', 11)->get()->toArray();
        $data['catesAll'] = array();
        //投资金额
        $data['amountAll'] = CateModel::where('pid', '=', 14)->get()->toArray();
        //合作模式
        $data['modelAll'] = CateModel::where('pid', '=', 15)->get()->toArray();
        //投资选址
        $data['txAll'] = CateModel::where('pid', '=', 16)->get()->toArray();
        //所属平台
        $data['ptAll'] = CateModel::where('pid', '=', 24)->get()->toArray();
        //适合人群
        $data['srAll'] = CateModel::where('pid', '=', 17)->get()->toArray();
        $data['logo'] = array();
        return view('admin.xm.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $xm = new XmModel();
        $xmdetail = new XmDetail();
        foreach (array_keys($this->fields) as $field) {
            if (!in_array($field, array('conditions','xmdesc','advantage','policies','analysis'))) {
                $xm->$field = $request->get($field);
            }else{
                if($request->get($field)){
                    $xmdetail->$field = htmlspecialchars($request->get($field));
                }else{
                    $xmdetail->$field = $request->get($field);
                }
            }
        }
        if ($request->get('name') == '') {
            return redirect()->back()->withErrors('项目名不能为空！');
        }
        if (empty($request->get('cid'))) {
            return redirect()->back()->withErrors('公司ID不能为空！');
        }

        $xm->created_at = date('Y-m-d H:i:s', time());
        $xm->updated_at = date('Y-m-d H:i:s', time());
        $xm->author = auth()->user()->id;
        $xm->save();
        $id = $xm->id;
        $content = $request->get('content');
        //公司简介
        if ($id) {
            $xmdetail->id = $id;
            $xmdetail->save();
        }
        //公司LOGO
        $picid = $request->get('picid');
        if ($id && $picid) {
            $picmodel = PictureModel::find($picid);
            $picmodel->xid = $id;
            $picmodel->content = $request->get('name');
            $picmodel->save();
        }

        return redirect('/admin/xm')->withSuccess('添加成功！');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $xm = XmModel::find((int) $id)->toArray();
        
        if (!$xm)
            return redirect('/admin/xm')->withErrors("找不到该项目!");
        $xmdetail = XmModel::find((int)$id)->getdetail->toArray();
        if(is_array($xm) && is_array($xmdetail)){
            $xm = array_merge($xm,$xmdetail);
        }
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $xm[$field]);
        }
        $logo = PictureModel::where('xid', '=', $id)->where('block', '=', 2)->where('type', '=', 1)->first();
        $data['logo'] = $logo;
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        $data['id'] = (int) $id;
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        //项目等级
        $data['gradeAll'] = CateModel::where('pid', '=', 18)->get()->toArray();
        //行业分类
        $data['cateAll'] = CateModel::where('pid', '=', 11)->get()->toArray();
        $data['catesAll'] = array();
        if($xm['cate']){
            $data['catesAll'] = CateModel::where('pid', '=', $xm['cate'])->get()->toArray();
        }
        //投资金额
        $data['amountAll'] = CateModel::where('pid', '=', 14)->get()->toArray();
        //合作模式
        $data['modelAll'] = CateModel::where('pid', '=', 15)->get()->toArray();
        //投资选址
        $data['txAll'] = CateModel::where('pid', '=', 16)->get()->toArray();
        //所属平台
        $data['ptAll'] = CateModel::where('pid', '=', 24)->get()->toArray();
        //适合人群
        $data['srAll'] = CateModel::where('pid', '=', 17)->get()->toArray();
        
        return view('admin.xm.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $xm = XmModel::find((int)$id);
        $xmdetail = Xmdetail::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            if (!in_array($field, array('conditions','xmdesc','advantage','policies','analysis'))) {
                $xm->$field = $request->get($field);
            }else{
                if($request->get($field)){
                    $xmdetail->$field = htmlspecialchars($request->get($field));
                }else{
                    $xmdetail->$field = $request->get($field);
                }
            }
        }
        if ($request->get('name') == '') {
            return redirect()->back()->withErrors('项目名不能为空！');
        }
        if (empty($request->get('cid'))) {
            return redirect()->back()->withErrors('公司ID不能为空！');
        }
        $xm->updated_at = date('Y-m-d H:i:s', time());
        $xm->save();
        //公司简介
        $xmdetail->save();
        
        $picid = $request->get('picid');
        $img = PictureModel::find($picid);
        if (empty($img['xid']) && $id && $picid) {
            $img->xid = $id;
            $img->content = $request->get('name');
            $img->save();
        }

        return redirect('/admin/xm')->withSuccess('修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $status = $request->get('status');
        $tag = XmModel::find((int) $id);
        if ($tag) {
            if($status){
                if($status==2){
                    $tag->status=0;
                }elseif($status==1){
                    $tag->status=1;
                }
                $tag->save();
            }else{
                $tags = Xmdetail::find((int) $id);
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
