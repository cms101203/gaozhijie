<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Picture as PictureModel;
use App\Models\Company as CompanyModel;
use Illuminate\Support\Facades\Input;
use Redirect, Response;

class UploadController extends Controller
{

    //Ajax上传图片
    public function imgUpload()
    {
        $file = Input::file('file');
        $id = Input::get('id');
        $ImgBs = Input::get("ImgBs");
        if(!empty($ImgBs)){
            $typearr = explode('-', $ImgBs);
        }
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }
        if($typearr[0]==1){
            $floder = "company";
        }elseif($typearr[0]==2){
            $floder = "xm";
        }else{
            $floder="ot";
        }
        $destinationPath = 'uploads/images/'.$floder."/".  date('Y-m-d')."/".  date('H')."/";
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $img = "/".$floder.'/'.  date('Y-m-d')."/".  date('H')."/".$fileName;
        $model = new PictureModel();
        $xid = 0;
        if(count($typearr)==3){
            
            if($typearr[1]==1){
                $model = PictureModel::where('xid','=',$typearr[2])->where('block','=',$typearr[0])->where('type','=',$typearr['1'])->first();
                if(empty($model)){
                    $model = new PictureModel();
                    $model->xid = $typearr[2];
                    $model->block = $typearr[0];
                    $model->type = $typearr[1];
                }
                $model->imgurl = $img;
                $model->create_at = date('Y-m-d H:i:s');
                $model->save();
                $xid = $model->id;
            }else{
                $model = new PictureModel();
                $model->xid = $typearr[2];
                $model->block = $typearr[0];
                $model->type = $typearr[1];
                $model->content = '暂无';
                $model->imgurl = $img;
                $model->create_at = date('Y-m-d H:i:s');
                $model->save();
                $xid = $model->id;
                if($xid){
                    $company = CompanyModel::find($typearr[2]);
                    $company->pape_num = intval($company['pape_num'])+1;
                    $company->save();
                    
                }
            }
        }else{
            $model->xid = 0;
            $model->block = $typearr[0];
            $model->type = $typearr[1];
            $model->content = '暂无';
            $model->imgurl = $img;
            $model->create_at = date('Y-m-d H:i:s');
            $model->save();
            $xid = $model->id;
        }
        if($typearr[0]==1 && $typearr[1]==2){
            $id = $id."_".$typearr[1];
        }
        return Response::json(
            [
                'success' => true,
                'pic' => asset($destinationPath.$fileName),
                'id' => $id,
                'xid' => $xid,
                'type'=>$typearr[1]
            ]
        );
    }
}
