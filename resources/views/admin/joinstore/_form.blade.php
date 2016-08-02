
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">项目ID</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="cid"  value="{{$cid}}" id="cid"  readonly>
        <span id="name_error" style="color: red;"></span>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">店面名称</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="storename"  value="{{ $storename}}" id="storename" >
        <span id="name_error" style="color: red;"></span>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">店面类型</label>
    <div class="btn-group col-md-1">
        <select class="form-control" name="type">
            <option value="0">默认</option>
            @foreach($typeAll as $k=>$v)
            <option @if($k==$type) selected @endif value="{{$k}}">{{$v}}</option>
            @endforeach
        </select>
     </div>
    <div class="btn-group col-md-1" id="cate_S">
     </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">成立时间</label>
    <div class="col-md-3">
        <div class="control-group">
          <div class="controls">
           <div class="input-prepend input-group">
             <span class="add-on input-group-addon">
                 <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
             </span>
              @if($foundtime)
               <input type="text" style="width: 200px"   name="foundtime" id="birthday" class="form-control" value="{{ date("Y-m-d",$foundtime)}}" />
              @else
                 <input type="text" style="width: 200px"   name="foundtime" id="birthday" class="form-control" value="" />
              @endif
           </div>
          </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">店面地址</label>
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
    <label for="tag" class="col-md-3 control-label">店面简介</label>
    <div class="col-md-6">
        <textarea  class="form-control" rows="7" style="width:100%;height:300px;" name="descrip" id="myEditor">{{$descrip}}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label"></label>
    <div class="col-md-5">
        <button type="button" class="btn btn-default status" value="0">禁用</button>
        <button type="button" class="btn btn-primary status" value="1">启用</button>
        <input type="hidden" value="{{$status}}" id="status" name="status" />
    </div>
</div>

<link href="/dist/uedit/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">


