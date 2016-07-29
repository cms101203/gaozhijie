<?php

namespace App\Http\Controllers\Admin;
use App\Events\permChangeEvent;
use App\Http\Requests\PapeCreateRequest;
use App\Models\Company as CompanyModel;
use App\Models\Xm as XmModel;
use App\Models\Picture as PictureModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route;

class PapeController extends Controller
{
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
      * 添加图片
      */
     public function create($id,$block){
         if($block==2){
             $result = XmModel::find((int)$id);
             $title = "找不到该项目";
             $url = "/admin/xm";
         }
        if (!$result)
            return redirect($url)->withErrors($title);
        
        $data['id'] = (int) $id;
        $data['block'] = $block;
        if($block==2){
            //店内实景拍摄
            $list = PictureModel::where('xid','=',$id)->where('block','=',$block)->get()->toArray();
            $data['list'] = $list;
            $data['dnum'] = count($list);
            $view = "admin.xm.xmtu";
        }
        
         
        return view($view, $data);
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
        $data['id'] = (int) $id;
        $list = PictureModel::where('xid','=',$id)->where('block','=',1)->where('type','=',2)->get()->toArray();
        $data['list'] = $list;
        $data['num'] = count($list);
        return view('admin.company.pape', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = array();
        $data = $request->get('data');
        $block = $request->get('block');
        if(empty($data)){
            return redirect()->back()->withErrors('没有内容需要修改');
        }
        foreach ($data as $v){
            $res = PictureModel::where('id','=',$v['id'])->update(array('content'=>$v['content']));
        }
        if($block==2){
            $view = '/admin/pape/'.$id."-".$block."/create";
        }else{
            $view = '/admin/pape/'.$id."/edit";
        }

        return redirect($view)->withSuccess('修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tag = PictureModel::find((int) $id);
        if ($tag) {
            $tag->delete();
            $filename = "uploads/images".$tag['imgurl'];
            @unlink($filename);
        } else {
            return redirect()->back()->withErrors("删除失败");
        }

        return redirect()->back()->withSuccess("删除成功");
    }
}
