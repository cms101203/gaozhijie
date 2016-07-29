@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="main animsition">
        <div class="container-fluid">

            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div style="padding-bottom: 10px;">
                               <select class="form-control" name="cate" id="xm_tk_type">
                                <option value="0">图片类型</option>
                                <option value="2">店内实景拍摄</option>
                                <option value="3">加盟店外观拍摄</option>
                                <option value="4">产品实拍图</option>
                                <option value="5">获奖证书</option>
                                <option value="6">专利证书</option>
                            </select>
                           </div>
                           <div class="btn btn-block btn-info btn-flat" id="Xm_tk_btn" title="点击上传">点击上传</div>
                           
                           <input type="hidden" value="{{$dnum}}" id="img_id">
                           <input type="hidden" value="{{$id}}" id="id">
                           <input type="hidden" value="{{$block}}" id="block">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                        </div>
                        <div class="panel-body">
                            @include('admin.partials.errors')
                            @include('admin.partials.success')
                            <form class="form-horizontal" role="form" method="POST" action="/admin/pape/{{ $id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="col-md-12"><h3>店内实景拍摄<h3></div>
                              @if($list)
                             @foreach($list as $k=>$v)
                             @if($v['type']==2)
                             <div class="col-sm-6 col-md-4 form-group" style="height:300px; width: 300px; margin-left: 10px;">
                                   <a class="thumbnail">
                                      <img id="tk_{{$k}}_2" src="/uploads/images{{$v['imgurl']}}"  class="img-thumbnail" width="180" height="300"> 
                                   </a>
                                  <div class="input-group">
                                      <input type="text" value="{{$v['content']}}" name="data[{{$k}}][content]" class="form-control"/>
                                      <input type="hidden" value="{{$v['id']}}" name="data[{{$k}}][id]"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default tk_del" id="{{$v['id']}}" type="button">
                                          <i class="fa fa-trash-o"></i>
                                       </button>
                                    </span>
                                 </div>
                                </div>
                              @endif
                              @endforeach
                              @endif
                              <div class="col-md-12"><h3>加盟店外观拍摄<h3></div>
                            @if($list)
                             @foreach($list as $k=>$v)
                             @if($v['type']==3)
                             <div class="col-sm-6 col-md-4 form-group" style="height:300px; width: 300px; margin-left: 10px;">
                                   <a class="thumbnail">
                                      <img id="tk_{{$k}}_2" src="/uploads/images{{$v['imgurl']}}"  class="img-thumbnail" width="180" height="300"> 
                                   </a>
                                  <div class="input-group">
                                      <input type="text" value="{{$v['content']}}" name="data[{{$k}}][content]" class="form-control"/>
                                      <input type="hidden" value="{{$v['id']}}" name="data[{{$k}}][id]"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default tk_del" id="{{$v['id']}}" type="button">
                                          <i class="fa fa-trash-o"></i>
                                       </button>
                                    </span>
                                 </div>
                                </div>
                              @endif
                              @endforeach
                              @endif
                              <div class="col-md-12"><h3>产品实拍图<h3></div>
                            @if($list)
                             @foreach($list as $k=>$v)
                             @if($v['type']==4)
                             <div class="col-sm-6 col-md-4 form-group" style="height:300px; width: 300px; margin-left: 10px;">
                                   <a class="thumbnail">
                                      <img id="tk_{{$k}}_2" src="/uploads/images{{$v['imgurl']}}"  class="img-thumbnail" width="180" height="300"> 
                                   </a>
                                  <div class="input-group">
                                      <input type="text" value="{{$v['content']}}" name="data[{{$k}}][content]" class="form-control"/>
                                      <input type="hidden" value="{{$v['id']}}" name="data[{{$k}}][id]"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default tk_del" id="{{$v['id']}}" type="button">
                                          <i class="fa fa-trash-o"></i>
                                       </button>
                                    </span>
                                 </div>
                                </div>
                              @endif
                              @endforeach
                              @endif
                              <div class="col-md-12"><h3>获奖证书<h3></div>
                            @if($list)
                             @foreach($list as $k=>$v)
                             @if($v['type']==5)
                             <div class="col-sm-6 col-md-4 form-group" style="height:300px; width: 300px; margin-left: 10px;">
                                   <a class="thumbnail">
                                      <img id="tk_{{$k}}_2" src="/uploads/images{{$v['imgurl']}}"  class="img-thumbnail" width="180" height="300"> 
                                   </a>
                                  <div class="input-group">
                                      <input type="text" value="{{$v['content']}}" name="data[{{$k}}][content]" class="form-control"/>
                                      <input type="hidden" value="{{$v['id']}}" name="data[{{$k}}][id]"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default tk_del" id="{{$v['id']}}" type="button">
                                          <i class="fa fa-trash-o"></i>
                                       </button>
                                    </span>
                                 </div>
                                </div>
                              @endif
                              @endforeach
                              @endif
                              <div class="col-md-12"><h3>专利证书<h3></div>
                             @if($list)
                             @foreach($list as $k=>$v)
                             @if($v['type']==6)
                             <div class="col-sm-6 col-md-4 form-group" style="height:300px; width: 300px; margin-left: 10px;">
                                   <a class="thumbnail">
                                      <img id="tk_{{$k}}_2" src="/uploads/images{{$v['imgurl']}}"  class="img-thumbnail" width="180" height="300"> 
                                   </a>
                                  <div class="input-group">
                                      <input type="text" value="{{$v['content']}}" name="data[{{$k}}][content]" class="form-control"/>
                                      <input type="hidden" value="{{$v['id']}}" name="data[{{$k}}][id]"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default tk_del" id="{{$v['id']}}" type="button">
                                          <i class="fa fa-trash-o"></i>
                                       </button>
                                    </span>
                                 </div>
                                </div>
                              @endif
                              @endforeach
                              @endif
                                <div class="form-group">
                                    <div class="col-md-7 col-md-offset-3">
                                        <input type="hidden" name="block" value="{{$block}}" />
                                        <button type="submit" class="btn btn-primary btn-md">
                                            <i class="fa fa-plus-circle"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @include('admin.layouts.upload_img')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <input type="hidden" id="reportrange" value="0"/>
    <div class="modal fade" id="modal-delete" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">提示</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i>确认要删除这个证件吗?
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="deleteForm" method="POST" action="/admin/category">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i>确认
                        </button>
                    </form>
                </div>

            </div>
    </div>
</div>
@stop