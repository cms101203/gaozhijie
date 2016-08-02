<div class="form-group">
    <label for="tag" class="col-md-3 control-label">标题</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="title"  value="{{ $title}}" id="storename" >
        <span id="name_error" style="color: red;"></span>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">开始时间</label>
    <div class="col-md-3">
        <div class="control-group">
          <div class="controls">
           <div class="input-prepend input-group">
             <span class="add-on input-group-addon">
                 <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
             </span>

                 <input type="text" style="width: 200px"   name="start"  class="form-control birthday" value="{{$start}}" />

           </div>
          </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">结束时间</label>
    <div class="col-md-3">
        <div class="control-group">
          <div class="controls">
           <div class="input-prepend input-group">
             <span class="add-on input-group-addon">
                 <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
             </span>

               <input type="text" style="width: 200px"   name="end"   class="form-control birthday" value="{{$end}}" />

           </div>
          </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">优惠信息</label>
    <div class="col-md-6">
        <textarea  class="form-control" rows="7" style="width:100%;height:300px;" name="content" id="myEditor">{{$content}}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label"></label>
    <div class="col-md-5">
        <button type="button" class="btn btn-default status" value="0">禁用</button>
        <button type="button" class="btn btn-primary status" value="1">启用</button>
        <input type="hidden" value="{{$sid}}" id="sid" name="sid" />
    </div>
</div>

<link href="/dist/uedit/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">


