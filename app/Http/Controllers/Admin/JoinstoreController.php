<?php
/**
 * 加盟店控制器
 */
namespace App\Http\Controllers\Admin;

use App\Models\Xm as XmModel;
use App\Models\Category as CateModel;
use App\Models\Joinstore;
use App\Models\JoinstoreDetail;
use App\Models\Region as RegionModel;
use App\Models\Picture as PictureModel;
use App\Models\AdminUser as User;
use App\Models\Xm;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JoinstoreController extends Controller{
    protected $fields = [
        'cid' => '',
        'storename' => '',
        'type'=>0,
        'foundtime'=>'',
        'province' => 0,
        'city' => 0,
        'address' => '',
        'descrip' => '',
        'status' => 1
    ];

    protected $typeAll = array(1=>'代理',2=>'加盟',3=>'连锁',4=>'直营');

    public function index(Request $request,$cid=0){

        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Joinstore::count();
            if ((strlen($search['id'])) >0 ||  $search['xname'] || $search['cid'] || $search['type'] != '' || $search['status'] != '') {
                $xmarr = array();
                if(trim($search['xname'])){
                    $xm = XmModel::where('name','like','%'.trim($search['xname']).'%')->get();
                    if($xm){
                        foreach($xm as $v){
                            $xmarr[] = $v['id'];
                        }
                    }
                }
                $data['recordsFiltered'] = Joinstore::where(function ($query) use ($search) {
                    if($search['id']){
                        $query->where('id', '=', $search['id']);
                    }
                    if($search['cid']){
                        $query->where('cid', '=', $search['cid']);
                    }
                    if(!empty($xmarr)){
                        $query->whereIn('cid', $xmarr);
                    }
                    if ($search['type']) {
                        $query->where("type", '=', $search['cid']);
                    }
                    if ($search['status'] != '') {
                        $query->where("status", '=', $search['status']);
                    }
                })->count();
                $data['data'] = Joinstore::where(function ($query) use ($search) {
                    if($search['id']){
                        $query->where('id', '=', $search['id']);
                    }
                    if($search['cid']){
                        $query->where('cid', '=', $search['cid']);
                    }
                    if(!empty($xmarr)){
                        $query->whereIn('cid', $xmarr);
                    }
                    if ($search['type']) {
                        $query->where("type", '=', $search['cid']);
                    }
                    if ($search['status'] != '') {
                        $query->where("status", '=', $search['status']);
                    }
                })->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get()->toArray();
            } else {
                $data['recordsFiltered'] = Joinstore::count();
                $data['data'] = Joinstore::skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get()->toArray();
            }
            if ($data['data']) {
                foreach ($data['data'] as $key => $value) {
                    $author = User::find($value['modifier']);
                    $data['data'][$key]['modifier'] = $author['name'];
                    $project = XmModel::find($value['cid']);
                    $data['data'][$key]['project'] = $project['name'];
                    //address
                    if ($value['province']) {
                        $province = RegionModel::where('region_id', '=', $value['province'])->first();
                        $data['data'][$key]['province'] = $province['region_name'];
                    }
                    if ($value['city']) {
                        $city = RegionModel::where('region_id', '=', $value['city'])->first();
                        $data['data'][$key]['city'] = $city['region_name'];
                    }
                    $data['data'][$key]['addtime']=date('Y-m-d',$value['addtime']);
                    $data['data'][$key]['modifytime']=date('Y-m-d',$value['modifytime']);

                }
            }
            return response()->json($data);
        }
        $data['cid']= $cid;
        return view('admin.joinstore.index',$data);
    }

    public function create($cid) {

        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['cid']= $cid;
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        $data['typeAll'] = $this->typeAll;
        $data['citylist'] = array();
        return view('admin.joinstore.create', $data);
    }


    public function store(Request $request){
        $joinModel = new Joinstore();
        foreach (array_keys($this->fields) as $field) {
            if ($field != 'descrip') {

                $joinModel->$field = $request->get($field);
            }

        }
        if ($request->get('storename') == '') {
            return redirect()->back()->withErrors('店名不能为空！');
        }
        if ($request->get('type') == '') {
            return redirect()->back()->withErrors('店面类型不能为空！');
        }
        if ($request->get('province') == '' || $request->get('city') == '' || $request->get('address') == ''  ) {
            return redirect()->back()->withErrors('店面地址不能为空！');
        }


        $joinModel->foundtime =strtotime($request->get('foundtime'));
        $joinModel->addtime = time();
        $joinModel->modifytime = time();
        $joinModel->editor = auth()->user()->id;
        $joinModel->modifier = auth()->user()->id;
        $joinModel->save();

        $id = $joinModel->id;
        $descrip = $request->get('descrip');
        //店面简介添加
        if($id && $descrip){
            $detailModle = new JoinstoreDetail();
            $detailModle->jid=$id;
            $detailModle->descrip=htmlspecialchars($descrip);
            $detailModle->save();

        }

        return redirect('/admin/joinstore/index')->withSuccess('添加成功！');

    }


    public function edit($id) {

        $joinstore = Joinstore::find((int) $id);

        if (!$joinstore)
            return redirect("/admin/joinstore/$id")->withErrors("找不到该公司!");

        foreach (array_keys($this->fields) as $field) {
            if ($field != 'descrip') {
                $data[$field] = old($field, $joinstore->$field);
            }
        }

        $detail = JoinstoreDetail::where('jid','=',$id)->get()->toArray();;


        if ($detail) {
            $data['descrip'] = htmlspecialchars_decode($detail[0]['descrip']);
        } else {
            $data['descrip'] = "暂无";
        }
        $logo = PictureModel::where('xid', '=', $id)->where('block', '=', 1)->where('type', '=', 1)->first();
        $data['logo'] = $logo;
        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
        $data['typeAll'] = $this->typeAll;
        if ($joinstore['province']) {
            $data['citylist'] = RegionModel::where('pid', '=', $joinstore['province'])->get()->toArray();
        }

        $data['id'] = (int) $id;

        return view('admin.joinstore.edit', $data);
    }


    public function update(Request $request) {
        $joinstore = Joinstore::find((int) $request->get('id'));

        foreach (array_keys($this->fields) as $field) {
            if ($field != 'descrip') {
                $joinstore->$field = $request->get($field);
            }
        }
        if ($request->get('storename') == '') {
            return redirect()->back()->withErrors('店名不能为空！');
        }
        if ($request->get('type') == '') {
            return redirect()->back()->withErrors('店面类型不能为空！');
        }
        $joinstore->modifytime = time();
        $joinstore->save();
        //公司简介
        $detail = new JoinstoreDetail();
        $detail->where('jid', $request->get('id'))->update(array('descrip'=>htmlspecialchars($request->get('descrip'))));
//        $picid = $request->get('picid');
//        $img = PictureModel::find($picid);
//        if (empty($img['xid']) && $id && $picid) {
//            $img->xid = $id;
//            $img->content = $request->get('name');
//            $img->save();
//        }

        return redirect("/admin/joinstore/index")->withSuccess('修改成功！');
    }

    public function destroy(Request $request, $id) {

        $status = $request->get('status');
        $tag = Joinstore::find((int) $id);
        if ($tag) {
            if($status){
                if($status==2){
                    $tag->status=0;
                }elseif($status==1){
                    $tag->status=1;
                }
                $tag->save();
            }else{
                $tags = JoinstoreDetail::where('jid','=',$id);
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

