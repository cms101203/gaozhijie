<div class="form-group">
    <label for="tag" class="col-md-3 control-label">公司名称</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="name"  value="{{ $name }}" id="company_name" >
        <span id="name_error" style="color: red;"></span>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">公司官网</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="url" id="tag" value="{{ $url }}" autofocus><span style="color: red;">示例:http://***</span>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">公司LOGO</label>
    <div class="col-md-2 thumb-wrap">
        <div class="pic-upload btn btn-block btn-info btn-flat" title="点击上传">点击上传</div>
        @if($logo)
        <img id="logo" src="/uploads/images{{$logo['imgurl']}}" width="121" height="75">
        <input type="hidden" value="1-1-{{$logo['xid']}}" id="ImgBs">
        <input type="hidden" name="picid" value="{{$logo['id']}}" id="PicID" />
        @else
        <img id="logo" src="" width="121" height="75">
        <input type="hidden" value="1-1" id="ImgBs">
        <input type="hidden" name="picid" value="" id="PicID" />
        @endif
   </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">企业类型</label>
    <div class="btn-group col-md-1">
        <select class="form-control" name="c_type">
            <option value="0">默认</option>
            @foreach($typeAll as $v)
            <option @if($v['id']==$c_type) selected @endif value="{{$v['id']}}">{{$v['name']}}</option>
            @endforeach
        </select>
     </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">成立时间</label>
    <div class="col-md-3">
        <div class="control-group">
          <div class="controls">
           <div class="input-prepend input-group date form_date"  data-date="" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
             <span class="add-on input-group-addon">
                 <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
             </span>
               <input type="text" readonly style="width: 200px"  name="mk_time" id="birthday" class="form-control" value="{{ $mk_time }}" /> 
           </div>
          </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">注册资金</label>
    
    <div class="col-md-2">
        <div class="input-group">
            <input type="text" class="form-control" name="mk_money" id="tag" value="{{ $mk_money }}" autofocus>
            <span class="input-group-addon">元</span>
        </div>
        
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">营业执照注册号</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="reg_code" id="tag" value="{{ $reg_code }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">税务登记证号</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="ck_code" id="tag" value="{{ $ck_code }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">组织机构代码证号</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="mc_code" id="tag" value="{{ $mc_code }}" autofocus>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">联系电话</label>
    <div class="col-md-2">
        <input type="text" class="form-control" name="mobile" id="tag" value="{{ $mobile }}" autofocus>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">联系邮箱</label>
    <div class="col-md-2">
        <input type="text" class="form-control" name="email" id="tag" value="{{ $email }}" autofocus>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">公司地址</label>
    <div class="btn-group col-md-1">
        <select class="form-control" name="province" id="province">
            <option value="0">默认</option>
            @foreach($regionlist as $v)
            <option @if($v['region_id']==$province) selected @endif value="{{$v['region_id']}}">{{$v['region_name']}}</option>
            @endforeach
        </select>
     </div>
    <div class="btn-group col-md-1" >
        <select class="form-control" name="city" id="city">
            <option value="0">默认</option>
            @if($citylist)
            @foreach($citylist as $v)
            <option value="{{$v['region_id']}}" @if($v['region_id']==$city) selected @endif >{{$v['region_name']}}</option>
            @endforeach
            @endif
        </select>
     </div>
    <div class="col-md-4">
        <input type="text" class="form-control" name="address" id="tag" value="{{ $address }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">公司简介</label>
    <div class="col-md-6">
        <textarea  class="form-control" rows="7" style="width:100%;height:300px;" name="content" id="myEditor">{{htmlspecialchars_decode($content)}}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label"></label>
    <div class="col-md-5">
        <button type="button" class="btn @if($status==0) btn-primary @else btn-default @endif status" value="0">禁用</button>
        <button type="button" class="btn @if($status==1) btn-primary @else btn-default @endif status" value="1">启用</button>
        <input type="hidden" value="{{$status}}" id="status" name="status" />
    </div>
</div>

<link href="/dist/uedit/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">

