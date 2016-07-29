<ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">项目信息</a></li>
    <li><a href="#spread" data-toggle="tab">项目信息扩展</a></li>
</ul>
<div id="myTabContent" class="tab-content" style="padding-top: 20px;">
    <div class="tab-pane fade in active" id="home">
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">项目名称</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="name"  value="{{ $name }}"  >
                <span id="name_error" style="color: red;">*</span>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">公司ID</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="cid" id="tag" value="{{ $cid }}" autofocus><span style="color: red;">*</span>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">公司LOGO</label>
            <div class="col-md-2 thumb-wrap">
                <div class="pic-upload btn btn-block btn-info btn-flat" title="点击上传">点击上传</div>
                @if($logo)
                <img id="logo" src="/uploads/images{{$logo['imgurl']}}" width="121" height="75">
                <input type="hidden" value="2-1-{{$logo['xid']}}" id="ImgBs">
                <input type="hidden" name="picid" value="{{$logo['id']}}" id="PicID" />
                @else
                <img id="logo" src="" width="121" height="75">
                <input type="hidden" value="2-1" id="ImgBs">
                <input type="hidden" name="picid" value="" id="PicID" />
                @endif
           </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">所属平台</label>
            <div class="col-md-5">
                <div class="checkbox" id="pt_ck">
                    <?php $ptarr = array(); if($pt) $ptarr = explode(',', $pt);?>
                   @if($ptAll)
                   @foreach($ptAll as $v)
                  <label>
                      <input type="checkbox" @if(in_array($v['id'],$ptarr)) checked @endif  value="{{$v['id']}}" class="pt_ck">{{$v['name']}} 
                  </label>
                   @endforeach
                   @endif
                   <input type="hidden" name="pt" value="{{$pt}}" />
               </div>
            </div>
         </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">所属行业</label>
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
            <label for="tag" class="col-md-3 control-label">成立时间</label>
            <div class="col-md-3">
                <div class="control-group">
                  <div class="controls">
                   <div class="input-prepend input-group date form_date"  data-date="" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                     <span class="add-on input-group-addon">
                         <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                     </span>
                       <input type="text" readonly style="width: 200px"  name="mktime" id="birthday" class="form-control" value="{{ $mktime }}" /> 
                   </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">发源地</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="cradle" id="tag" value="{{ $cradle }}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">项目故事</label>
            <div class="col-md-6">
                <textarea  class="form-control" rows="7" style="width:100%;height:250px;" name="story" id="myEditor">{{$story}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">商标注册号</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="chopcode" id="tag" value="{{ $chopcode }}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">首店成立时间</label>
            <div class="col-md-3">
                <div class="control-group">
                  <div class="controls">
                   <div class="input-prepend input-group date form_date"  data-date="" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                     <span class="add-on input-group-addon">
                         <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                     </span>
                       <input type="text" readonly style="width: 200px"  name="firstime"  class="form-control birthday" value="{{ $firstime }}" /> 
                   </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">直营店数量</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="directnum" id="tag" value="{{ $directnum }}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">加盟/代理店数量</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="proxynum" id="tag" value="{{ $proxynum }}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">投资金额</label>
            <div class="btn-group col-md-1">
                <select class="form-control" name="amount">
                    <option value="0">默认</option>
                    @foreach($amountAll as $v)
                    <option @if($v['id']==$amount) selected @endif value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                </select>
             </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">投资选址</label>
            <div class="col-md-5">
                <div class="checkbox" id="locat_ck">
                   @if($txAll)
                   <?php $txarr = array(); if($locat) $txarr = explode(',', $locat);?>
                   @foreach($txAll as $v)
                  <label>
                      <input type="checkbox" @if(in_array($v['id'],$txarr)) checked @endif value="{{$v['id']}}" class="locat_ck">{{$v['name']}} 
                  </label>
                   @endforeach
                   @endif
                   <input type="hidden" name="locat" value="{{$locat}}" />
               </div>
            </div>
         </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">适合人群</label>
            <div class="col-md-5">
                <div class="checkbox" id="crowd_ck">
                   @if($srAll)
                   <?php $srarr = array(); if($crowd) $srarr = explode(',', $crowd);?>
                   @foreach($srAll as $v)
                  <label>
                      <input type="checkbox"  @if(in_array($v['id'],$srarr)) checked @endif value="{{$v['id']}}" class="crowd_ck">{{$v['name']}} 
                  </label>
                   @endforeach
                   @endif
                   <input type="hidden" name="crowd" value="{{$crowd}}" />
               </div>
            </div>
         </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">合作模式</label>
            <div class="btn-group col-md-1">
                <select class="form-control" name="models">
                    <option value="0">默认</option>
                    @foreach($modelAll as $v)
                    <option @if($v['id']==$models) selected @endif value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                </select>
             </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">招商地区</label>
            <div class="col-md-5">
                <button type="button" class="btn btn-info" id="btnAddProvince">选择地区</button>
                <?php $zsarr = array(); if($zsarea) $zsarr = explode(',', $zsarea);?>
                <span id="zsarea_xz">
                    @if($regionlist && !empty($zsarr))
                    @foreach($regionlist as $v)
                       @if(in_array($v['region_id'],$zsarr))
                       <button type="button" class="btn btn-link">{{$v['region_name']}}</button>
                       @endif
                    @endforeach
                    @endif
                </span>
                <input type="hidden" name="zsarea" value="{{$zsarea}}" />
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">项目等级</label>
            <div class="btn-group col-md-1">
                <select class="form-control" name="grade">
                    <option value="0">默认</option>
                    @foreach($gradeAll as $v)
                    <option @if($v['id']==$grade) selected @endif value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                </select>
             </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">项目积分</label>
            <div class="col-md-5">
                <input type="number" class="form-control" name="score" id="tag" value="{{ $score }}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">加盟费</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="infee" id="tag" value="{{ $infee }}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">主营产品</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="product" id="tag" value="{{ $product}}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">项目亮点</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="lights" id="tag" value="{{ $lights}}" autofocus>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="spread">
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">项目广告语</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="slogan" id="tag" value="{{ $slogan}}" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">加盟条件</label>
            <div class="col-md-6">
                <textarea  class="form-control" rows="7" style="width:100%;height:250px;" name="conditions" id="conditions">{{$conditions}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">项目简介</label>
            <div class="col-md-6">
                <textarea  class="form-control" rows="7" style="width:100%;height:250px;" name="xmdesc" id="xmdesc">{{$xmdesc}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">加盟优势</label>
            <div class="col-md-6">
                <textarea  class="form-control" rows="7" style="width:100%;height:250px;" name="advantage" id="advantage">{{$advantage}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">支持政策</label>
            <div class="col-md-6">
                <textarea  class="form-control" rows="7" style="width:100%;height:250px;" name="policies" id="policies">{{$policies}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label">盈利分析</label>
            <div class="col-md-6">
                <textarea  class="form-control" rows="7" style="width:100%;height:250px;" name="analysis" id="analysis">{{$analysis}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="tag" class="col-md-3 control-label"></label>
            <div class="col-md-5">
                <button type="button" class="btn  @if($status==0) btn-primary @else btn-default @endif status" value="0">禁用</button>
                <button type="button" class="btn @if($status==1) btn-primary @else btn-default @endif status" value="1">启用</button>
                <input type="hidden" value="{{$status}}" id="status" name="status" />
            </div>
        </div>
    </div>
</div>

<link href="/dist/uedit/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">

<div class="modal fade" id="dialog_selectProvince" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">请选择招商地区</h4>
            </div>
            <div class="modal-body form-group" style="margin-left:10px;">
                <div class="col-md-2 checkbox">
                    <input type="checkbox" value="9999" title="全国" class="crowd_ck">全国
                </div>
                @if($regionlist)
                @foreach($regionlist as $v)
                <div class="col-md-2 checkbox">
                   <input type="checkbox" value="{{$v['region_id']}}"  title="{{$v['region_name']}}" class="crowd_ck">{{$v['region_name']}} 
                </div>
                @endforeach
                @endif
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" id="zsarea_ck" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>确认
                    </button>
            </div>
        </div>
    </div>
</div>


