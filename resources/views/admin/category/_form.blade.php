<div class="form-group">
    <label for="tag" class="col-md-3 control-label">分类名称</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="name" id="tag" value="{{ $name }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">父级分类</label>
    <div class="btn-group col-md-1">
        <select class="form-control"  id="cate_F">
            <option value="0">顶级</option>
            @foreach($cateAll as $v)
            <option @if($v['id']==$catef) selected @endif value="{{$v['id']}}">{{$v['name']}}</option>
            @endforeach
        </select>
     </div>
    <div class="btn-group col-md-1" >
        <select class="form-control"  id="cate_S">
            <option value="0">默认</option>
            @if($catesAll)
            @foreach($catesAll as $v)
            <option @if($v['id']==$cates) selected @endif value="{{$v['id']}}">{{$v['name']}}</option>
            @endforeach
            @endif
        </select>
     </div>
    <input type="hidden" name="pid" value="{{$pid}}" id="pid"/>
    <input type="hidden" name="pids" value="{{$pids}}" id="pids"/>
    <input type="hidden" name="grade" value="{{$grade}}" id="grade"/>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">简拼</label>
    <div class="col-md-2">
        <input type="text" class="form-control" name="abbr" id="tag" value="{{ $abbr }}" autofocus>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">品牌分类</label>
    <div class="col-md-5">
        <button type="button" class="btn btn-primary xm_type" value="1">是</button>
        <button type="button" class="btn btn-default  xm_type" value="0">否</button>
        <input type="hidden" value="{{$xm_type}}" id="xm_type" name="xm_type" />
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">资讯分类</label>
    <div class="col-md-5">
        <button type="button" class="btn btn-primary zx_type" value="1">是</button>
        <button type="button" class="btn btn-default zx_type" value="0">否</button>
        <input type="hidden" value="{{$zx_type}}" id="zx_type" name="zx_type" />
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">排序</label>
    <div class="col-md-2">
        <input type="number" class="form-control" name="seq"  id="tag" value="{{ $seq }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">优化标题</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="title" id="tag" value="{{ $title }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">优化关键字</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="keyword" id="tag" value="{{ $keyword }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">优化简介</label>
    <div class="col-md-5">
        <textarea  class="form-control" rows="7" name="content" id="tag">{{$content}}</textarea>
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
