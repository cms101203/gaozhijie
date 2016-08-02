<?php
/**
 * 加盟店控制器
 */
namespace App\Http\Controllers\Admin;

use App\Models\Discount;
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

class DiscountController extends Controller{
    protected $fields = [
        'sid' => '',
        'title' => '',
        'start'=>'',
        'end'=>'',
        'content'=>''
    ];


    public function index(Request $request,$sid=0){
        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Discount::count();
            if ($search['sid']>0 ||  $search['xname'] ) {
                $xmarr = array();
                if(trim($search['xname'])){
                    $xm = Joinstore::where('storename','like','%'.trim($search['xname']).'%')->get();
                    if($xm){
                        foreach($xm as $v){
                            $xmarr[] = $v['id'];
                        }
                    }
                }
                $data['recordsFiltered'] = Discount::where(function ($query) use ($search) {
                    if($search['sid']){
                        $query->where('sid', '=', $search['sid']);                    }

                    if(!empty($xmarr)){
                        $query->whereIn('sid', $xmarr);
                    }
                })->count();
                $data['data'] = Discount::where(function ($query) use ($search) {
                    if($search['sid']){
                        $query->where('sid', '=', $search['sid']);
                    }
                    if(!empty($xmarr)){
                        $query->whereIn('sid', $xmarr);
                    }
                })->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get()->toArray();
            }else{
                $data['recordsFiltered'] = Discount::count();
                $data['data'] = Discount::skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get()->toArray();
            }


            if ($data['data']) {
                foreach ($data['data'] as $key => $value) {
                    $author = User::find($value['editor']);
                    $data['data'][$key]['editor'] = $author['name'];
//                    $project = XmModel::find($value['id']);
//                    $data['data'][$key]['project'] = $project['name'];
                    //address
//                    if ($value['province']) {
//                        $province = RegionModel::where('region_id', '=', $value['province'])->first();
//                        $data['data'][$key]['province'] = $province['region_name'];
//                    }
//                    if ($value['city']) {
//                        $city = RegionModel::where('region_id', '=', $value['city'])->first();
//                        $data['data'][$key]['city'] = $city['region_name'];
//                    }
//                    $data['data'][$key]['addtime']=date('Y-m-d',$value['addtime']);
//                    $data['data'][$key]['modifytime']=date('Y-m-d',$value['modifytime']);

                }
            }

            return response()->json($data);
        }

        $data['sid']= $sid;

        return view('admin.discount.index',$data);
    }

    public function create($cid) {

        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['sid']= $cid;

        return view('admin.discount.create', $data);
    }


    public function store(Request $request){
        $discountModel = new Discount();
        foreach (array_keys($this->fields) as $field) {
            $discountModel->$field = $request->get($field);
        }
        if ($request->get('title') == '') {
            return redirect()->back()->withErrors('标题不能为空！');
        }
        if ($request->get('content') == '') {
            return redirect()->back()->withErrors('优惠内容不能为空！');
        }
        if (strtotime($request->get('start')) >strtotime($request->get('end'))  ) {
            return redirect()->back()->withErrors('结束时间不能小于开始时间！');
        }
        $discountModel->addtime = date('Y-m-d',time());
        $discountModel->editor = auth()->user()->id;
        $discountModel->save();

        return redirect('/admin/discount/index')->withSuccess('添加成功！');

    }


    public function edit($id) {

        $discount = Discount::find((int) $id);

        if (!$discount)
            return redirect("/admin/discount/$id")->withErrors("找不到该优惠信息!");

        foreach (array_keys($this->fields) as $field) {
                $data[$field] = old($field, $discount->$field);

        }
//
//
//        $logo = PictureModel::where('xid', '=', $id)->where('block', '=', 1)->where('type', '=', 1)->first();
//        $data['logo'] = $logo;
//        $data['regionlist'] = RegionModel::where('grade', '=', 2)->get()->toArray();
//        $data['typeAll'] = $this->typeAll;
//        if ($joinstore['province']) {
//            $data['citylist'] = RegionModel::where('pid', '=', $joinstore['province'])->get()->toArray();
//        }

        $data['id'] = (int) $id;

        return view('admin.joinstore.edit', $data);
    }


    public function update(Request $request) {
        $joinstore = Discount::find((int) $request->get('id'));

        foreach (array_keys($this->fields) as $field) {
                $joinstore->$field = $request->get($field);
        }
        if ($request->get('title') == '') {
            return redirect()->back()->withErrors('标题不能为空！');
        }
        if ($request->get('content') == '') {
            return redirect()->back()->withErrors('优惠内容不能为空！');
        }
        if (strtotime($request->get('start')) >strtotime($request->get('end'))  ) {
            return redirect()->back()->withErrors('结束时间不能小于开始时间！');
        }
        $joinstore->save();
//        //公司简介
//        $detail = new JoinstoreDetail();
//        $detail->where('jid', $request->get('id'))->update(array('descrip'=>htmlspecialchars($request->get('descrip'))));
//        $picid = $request->get('picid');
//        $img = PictureModel::find($picid);
//        if (empty($img['xid']) && $id && $picid) {
//            $img->xid = $id;
//            $img->content = $request->get('name');
//            $img->save();
//        }
//         $id=$request->get('sid');
        return redirect("/admin/discount/index/")->withSuccess('修改成功！');
    }

    public function destroy(Request $request, $id) {


        $tag = Discount::find((int) $id);
        if ($tag) {

              $tag->delete();


        } else {
            return redirect()->back()->withErrors("操作失败");
        }

        return redirect()->back()->withSuccess("操作成功");
    }






}

