<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category as CateModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller {

    protected $fields = [
        'name' => '',
        'abbr' => '',
        'pid' => 0,
        'pids' => 0,
        'grade'=>1,
        'zx_type' => 1,
        'seq' => 0,
        'title' => '',
        'xm_type' => 1,
        'keyword' => '',
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
            
            $data['recordsTotal'] = CateModel::count();
            if (strlen($search['value']) > 0 || $search['pid']) { 
                $data['recordsFiltered'] = CateModel::where(function ($query) use ($search) {
                            if($search['value']){
                                $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                            }
                            if($search['pid']){
                                $query->where('pid', '=', (int)$search['pid']);
                            }
                        })->count();
                $data['data'] = CateModel::where(function ($query) use ($search) {
                            if($search['value']){
                                $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                            }
                            if($search['pid']){
                                $query->where('pid', '=', (int)$search['pid']);
                            }
                        })
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
            } else {
                $data['recordsFiltered'] = CateModel::count();
                $data['data'] = CateModel::where('pid', '=', 0)
                        ->skip($start)->take($length)
                        ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                        ->get();
            }
            return response()->json($data);
        }
        return view('admin.category.index');
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
        $data['catef'] = 0;
        $data['catesAll'] = array();
        $data['cateAll'] = CateModel::all()->where('pid','=', 0)->toArray();
        return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $cate = new CateModel();
        foreach (array_keys($this->fields) as $field) {
            $cate->$field = $request->get($field);
        }
        if ($request->get('name')=='') {
            return redirect()->back()->withErrors('分类名不能为空！');
        }
        if ($request->get('abbr')=='') {
            return redirect()->back()->withErrors('分类简拼不能为空！');
        }
        $cate->created_at = date('Y-m-d H:i:s',  time());
        $cate->updated_at = date('Y-m-d H:i:s',  time());
        $cate->save();
        
        return redirect('/admin/category')->withSuccess('添加成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $cate = CateModel::find((int) $id);
        if (!$cate)
            return redirect('/admin/category')->withErrors("找不到该分类!");
        
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $cate->$field);
        }
        $data['cateAll'] = CateModel::all()->where('pid','=', 0)->toArray();
        $data['catef'] = $cate['pid'];
        $data['catesAll'] = array();
        if($cate['grade']>2){
            $pidarr = explode(',', $cate['pids']);
            $data['catesAll'] = CateModel::where('pid','=', $pidarr[1])->get()->toArray();
            $data['cates'] = $pidarr[0];
            $data['catef'] = $pidarr[1];
        }
        
        $data['id'] = (int) $id;
//        print_r($data);exit;
        return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $cate = CateModel::find((int) $id);
        foreach (array_keys($this->fields) as $field) {
            $cate->$field = $request->get($field);
        }
        
        if ($request->get('name')=='') {
            return redirect()->back()->withErrors('分类名不能为空！');
        }
        if ($request->get('abbr')=='') {
            return redirect()->back()->withErrors('分类简拼不能为空！');
        }
        if($request->get('pid')==0){
            $cate->pids = 0;
        }else{
            $cate->pids = $request->get('pid').",0";
        }
        $cate->updated_at = date('Y-m-d H:i:s',  time());

        $cate->save();

        return redirect('/admin/category')->withSuccess('修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tag = CateModel::find((int) $id);
        if ($tag && $tag->id != 1) {
            $tag->delete();
        } else {
            return redirect()->back()->withErrors("删除失败");
        }

        return redirect()->back()->withSuccess("删除成功");
    }

    /**
     * 根据父类 获取子类
     */
    public function cateson(Request $request) {
        $id = $request->get('id');
        $list = CateModel::where('pid', '=', (int) $id)->get()->toArray();
        $str = '<option value="0">默认</option>';
        if ($list) {
            foreach ($list as $v) {
                $str .='<option value="' . $v['id'] . '">' . $v['name'] . "</option>";
            }
        }
        return json_encode(array('str' => $str));
    }

}
