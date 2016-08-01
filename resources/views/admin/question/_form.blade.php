<ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">问答信息</a></li>
    
</ul>
<div id="myTabContent" class="tab-content" style="padding-top: 20px;">
    <div class="tab-pane fade in active" id="home">
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">标题</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="title"  value="{{ $title }}"  >
                <span id="name_error" style="color: red;">*</span>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">所属平台</label>
            <div class="col-md-5">
                <div class="checkbox" id="pt_art_ck">
                   @if($ptAll)
                   @foreach($ptAll as $v)
                  <label>
                      <input type="radio" name="pt" @if($v['id']==$pt) checked @endif  value="{{$v['id']}}" class="pt_art_ck">{{$v['name']}} 
                  </label>
                   @endforeach
                   @endif
                   <span id="name_error" style="color: red;">*</span>
               </div>
            </div>
         </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">项目ID</label>
            <div class="col-md-5">
                <input type="text" class="form-control typeahead" name="xid" id="search_xm" value="{{ $xid }}"  data-items="8"  /><span style="color: red;" id="xiderr">*</span>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">行业</label>
            <div class="btn-group col-md-1">
                <select class="form-control" name="cate" id="cate_F">
                    <option value="0">一级行业</option>
                    @foreach($cateAll as $v)
                    <option @if($v['id']==$cate) selected @endif value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                </select>
             </div>
            <div class="btn-group">
                <select class="form-control" name="cates" id="cate_S">
                    <option value="0">二级行业</option>
                    @if($catesAll)
                    @foreach($catesAll as $v)
                    <option @if($v['id']==$cates) selected @endif value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                    @endif
                </select>
             </div>
        </div>

        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">地区</label>
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
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">人群</label>
            <div class="btn-group col-md-1">
                <select class="form-control" name="people">
                    <option value="0">默认</option>
                    @if($srAll)
                    @foreach($srAll as $v)
                    <option value="{{$v['id']}}" @if($v['id']==$people) selected @endif >{{$v['name']}}</option>
                    @endforeach
                    @endif
                </select>
             </div>
        </div> 
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">简介</label>
            <div class="col-md-4">
                <textarea  class="form-control" rows="7"  name="summary">{{$summary}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">内容</label>
            <div class="col-md-6">
                <textarea  class="form-control" rows="7" style="width:100%;height:250px;" name="content" id="xmdesc">{{htmlspecialchars_decode($content)}}</textarea>
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
    </div>
</div>

<link href="/dist/uedit/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">




