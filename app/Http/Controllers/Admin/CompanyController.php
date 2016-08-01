<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company as CompanyModel;
use App\Models\CompanyDetail as CompanyDetailModel;
use App\Models\Category as CateModel;
use App\Models\Region as RegionModel;
use App\Models\Picture as PictureModel;
use App\Models\AdminUser as User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller {

    protected $fields = [
        'name' => '',
        'url' => '',
        'c_type' => '',
        'mk_time' => '',
        'mk_money' => '',
        'reg_code' => '',
        'ck_code' => '',
        'mc_code' => 1,
        'mobile' => '',
        'email' => '',
        'city' => 0,
        'province' => 0,
        'address' => '',
        'content' => '',
        'status' => 1
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
            $data['recordsTotal'] = CompanyModel::count();
            if (strlen($search['value']) > 0 || $search['cid'] || $search['status'] != '') {
                $data['recordsFiltered'] = CompanyModel::where(function ($query) use ($search) {
                            if (strlen($search['value']) > 0) {
                                $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                            }
                            if ($search['cid']) {
                                $query->where("id", '=', $search['cid']);
                            }
                            if ($search['status'] != '') {
                                $query->where("status", '=', $search['status']);
                            }
                        })->count();
                $data['data'] = CompanyModel::where(function ($query) use ($search) {
                                    if (strlen($search['value']) > 0) {
                                        $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                                    }
                                    if ($search['cid']) {
                                        $query->where("id", '=', $search['cid']);
                                    }
                                    if ($search['status'] != '') {
                                        $query->where("status", '=', $search['status']);
                                    }
                                })->skip($start)->take($length)
                                ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                                ->get()->toArray();
            } else {
                $data['recordsFiltered'] = CompanyModel::count();
                $data['data'] = CompanyModel::skip($start)->take($length)
                                ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                                ->get()->toArray();
            }
            if ($data['data']) {
                foreach ($data['data'] as $key => $value) {
                    $author = User::find($value['author']);
                    $data['data'][$key]['author'] = $author['name'];
                    //logo
                    $img = PictureModel::where("xid", '=', $value['id'])->where('block', '=', 1)->where('type', '=', 1)->first();
                    if ($img) {
                        $data['data'][$key]['logo'] = "/uploads/images" . $img['imgurl'];
                    } else {
                        $data['data'][$key]['logo'] = "暂无";
                    }
                    //address
                    if ($value['province']) {
                        $province = RegionModel::where('region_id', '=', $value['province'])->first();
                        $data['data'][$key]['province'] = $province['region_name'];
                    }
                    if ($value['city']) {
                        $city = RegionModel::where('region_id', '=', $value['city'])->first();
                        $data['data'][$key]['city'] = $city['region_name'];
                    }
                }
            }
            return response()->json($data);
        }
        return view('admin.company.index');
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
        $data['typeAll'] = CateModel::where('pid', '=', 8)->get()->toArray();
        $data['logo'] = array();
        $data['citylist'] = array();
        return view('admin.company.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $compay = new CompanyModel();
        foreach (array_keys($this->fields) as $field) {
            if ($field != 'content') {
                $compay->$field = $request->get($field);
            }
        }
        if ($request->get('name') == '') {
            return redirect()->back()->withErrors('公司名不能为空！');
        }
        if ($request->get('c_type') == '') {
            return redirect()->back()->withErrors('企业类型不能为空！');
        }

        $compay->created_at = date('Y-m-d H:i:s', time());
        $compay->updated_at = date('Y-m-d H:i:s', time());
        $compay->author = auth()->user()->id;
        $compay->save();
        $id = $compay->id;
        $content = $request->get('content');
        //公司简介
        if ($id && $content) {
            $detail = new CompanyDetailModel();
            $detail->id = $id;
            $detail->content = htmlspecialchars($content);
            $detail->save();
        }
        //公司LOGO
        $picid = $request->get('picid');
        if ($id && $picid) {
            $picmodel = PictureModel::find($picid);
            $picmodel->xid = $id;
            $picmodel->content = $request->get('name');
            $picmodel->save();
        }

        return redirect('/admin/company')->withSuccess('添加成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        $key = trim($request->get('keyword'));
        $result = CompanyModel::where('name', 'LIKE', $key)->get();
        return json_encode(array('num' => count($result)));
    }

    /**
     * 根据省ID 获取城市
     */
    public function region(Request $request) {
        $id = $request->get('id');
        $list = RegionModel::where('pid', '=', (int) $id)->get()->toArray();
        $str = '<option value="0">默认</option>';
        if ($list) {
            foreach ($list as $v) {
                $str .='<option value="' . $v['region_id'] . '">' . $v['region_name'] . "</option>";
            }
        }
        return json_encode(array('str' => $str));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $company = CompanyModel::find((int) $id);
        if (!$company)
            return redirect('/admin/company')->withErrors("找不到该公司!");

        foreach (array_keys($this->fields) as $field) {
            if ($field != 'content') {
                $data[$field] = old($field, $company->$field);
            }
        }
        $detail = CompanyDetailModel::find((int) $id);
        if ($detail) {
            $data['content'] = htmlspecialchars_decode($detail['content']);
        } else {
            $data['content'] = "暂无";
        }
        $logo = PictureModel::where('xid', '=', $id)->where('block', '=', 1)->where('type', '=', 1)->first();
        $data['logo'] = $logo;
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        $data['typeAll'] = CateModel::where('pid', '=', 8)->get()->toArray();
        if ($company['province']) {
            $data['citylist'] = RegionModel::where('pid', '=', $company['province'])->get()->toArray();
        }
        $data['id'] = (int) $id;
        return view('admin.company.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $compay = CompanyModel::find((int) $id);
        foreach (array_keys($this->fields) as $field) {
            if ($field != 'content') {
                $compay->$field = $request->get($field);
            }
        }

        if ($request->get('name') == '') {
            return redirect()->back()->withErrors('公司名不能为空！');
        }
        if ($request->get('c_type') == '') {
            return redirect()->back()->withErrors('企业类型不能为空！');
        }
        $compay->updated_at = date('Y-m-d H:i:s', time());
        $compay->save();
        //公司简介
        $detail = CompanyDetailModel::find((int) $id);
        $detail->id = (int) $id;
        $detail->content = htmlspecialchars($request->get('content'));
        $detail->save();
        $picid = $request->get('picid');
        $img = PictureModel::find($picid);
        if (empty($img['xid']) && $id && $picid) {
            $img->xid = $id;
            $img->content = $request->get('name');
            $img->save();
        }

        return redirect('/admin/company')->withSuccess('修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $status = $request->get('status');
        $tag = CompanyModel::find((int) $id);
        if ($tag) {
            if($status){
                if($status==2){
                    $tag->status=0;
                }elseif($status==1){
                    $tag->status=1;
                }
                $tag->save();
            }else{
                $tags = CompanyDetailModel::find((int) $id);
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
    
    public function ajax(Request $request){
        $key = $request->get('query');
        $data = array();
        $data['query'] = $key;
        $data['keyword'] = $key;
        $data['count'] = 10;
        if(trim($key)){
            $list = CompanyModel::where('name','like','%'.trim($key)."%")->get()->toArray();
            if($list){
                foreach ($list as $k=>$v){
                    $data['data'][$k]['id'] = $v['id'];
                    $data['suggestions'][] = $v['name'];
                }
            }
        }
        return json_encode($data);
    }

}
