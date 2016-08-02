
@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-8">
              <div class="xm-sc">
                <select class="form-control" name="cate" id="cate_F">
                    <option value="0">一级行业</option>
                    @foreach($cateAll as $v)
                    <option value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                </select>
             </div>
             <div class="xm-sc">
                <select class="form-control" name="cates" id="cate_S">
                    <option value="0">二级行业</option>
                    @if($catesAll)
                    @foreach($catesAll as $v)
                    <option  value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                    @endif
                </select>
             </div>
            <div class="xm-sc">
                <select class="form-control" id='Sel_status'>
                    <option value="">状态</option>
                    <option value="1">显示</option>
                    <option value="0">隐藏</option>
                </select>
            </div>
            <div class="xm-sc">
                <select class="form-control" id="Sel_sr">
                    <option value="0">人群</option>
                    @if($srAll)
                    @foreach($srAll as $v)
                    <option  value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="xm-sc">
                <select class="form-control" name="province" id="province">
                    <option value="0">省/市</option>
                    @foreach($regionlist as $v)
                    <option  value="{{$v['region_id']}}">{{$v['region_name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="xm-sc">
               <select class="form-control" name="city" id="city">
                    <option value="0">城市</option>
                    @if($citylist)
                    @foreach($citylist as $v)
                    <option value="{{$v['region_id']}}"  >{{$v['region_name']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="xm-sc">
                <select class="form-control" id="Sel_pt">
                    <option value="0">平台</option>
                    @if($ptAll)
                    @foreach($ptAll as $v)
                    <option  value="{{$v['id']}}">{{$v['name']}}</option>
                    @endforeach
                    @endif
                </select>
             </div>
            <div class="xm-sc">
                <input class="form-control" type="number" id="Xm_id"  placeholder="项目ID" />
            </div>
            <div class="xm-sc-txt">
                <input class="form-control" type="text" id="Wz_title"  placeholder="问答标题" />
            </div>
            <div class="xm-sc-txt">
                <input class="form-control" type="text" id="Wz_author"  placeholder="问答编辑" />
            </div>
            <div class="xm-sc-txt">
                <input class="form-control" type="number" id="Wz_id"  placeholder="问答ID" />
            </div>
            
            <div class="xm-sc-txt">
                <div class="control-group">
                  <div class="controls">
                   <div class="input-prepend input-group date form_date"  data-date="" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                     
                       <input type="text" readonly   class="form-control wzbirthday" id="Wd_date" value=""  placeholder="添加时间" /> 
                   </div>
                  </div>
                </div>
            </div>
            
            <div class="xm-sc">
                <button type="button birthday" class="btn btn-success" id="Search_btn">查询</button>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <a href="/admin/question/create" class="btn btn-success btn-md">
                <i class="fa fa-plus-circle"></i> 添加问答
            </a>
        </div>
    </div>
    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
        </div>
    </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                    @include('admin.partials.errors')
                    @include('admin.partials.success')
                    <div class="box-body">
                    <table id="tags-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="hidden-sm">ID</th>
                            <th>问答ID</th>
                            <th data-sortable="false">标题</th>
                            <th data-sortable="false">添加时间</th>
                            <th data-sortable="false">项目</th>
                            <th data-sortable="false">行业</th>
                            <th data-sortable="false">人群</th>
                            <th data-sortable="false">地区</th>
                            <th data-sortable="false">平台</th>
                            <th data-sortable="false">作者</th>
                            <th data-sortable="false">状态</th>
                            <th data-sortable="false">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                        <i class="fa fa-question-circle fa-lg"></i>
                        确认要删除这个问答吗?
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="deleteForm" method="POST" action="/admin/category">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="status" value="0"/>
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

@section('js')
    <script>
        $(function () {
            var table = $("#tags-table").DataTable({
                language: {
                    "sProcessing": "处理中...",
                    "sLengthMenu": "显示 _MENU_ 项结果",
                    "sZeroRecords": "没有匹配结果",
                    "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                    "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                    "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                    "sInfoPostFix": "",
                    "sSearch": "搜索:",
                    "sUrl": "",
                    "sEmptyTable": "表中数据为空",
                    "sLoadingRecords": "载入中...",
                    "sInfoThousands": ",",
                    "oPaginate": {
                        "sFirst": "首页",
                        "sPrevious": "上页",
                        "sNext": "下页",
                        "sLast": "末页"
                    },
                    "oAria": {
                        "sSortAscending": ": 以升序排列此列",
                        "sSortDescending": ": 以降序排列此列"
                    }
                },
                order: [[0, "desc"]],
                serverSide: true,
                bLengthChange:false,
                searching:false,
                ajax: {
                    url: '/admin/question/index',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    "data": function ( d ) {
                       //添加额外的参数传给服务器
                        d.search['id'] = $('#Wz_id').val();
                        d.search['cate'] = $('#cate_F').val();
                        d.search['cates'] = $('#cate_S').val();
                        d.search['status'] = $('#Sel_status').val();
                        d.search['people'] = $('#Sel_sr').val();
                        d.search['pt'] = $('#Sel_pt').val();
                        d.search['province'] = $('#province').val();
                        d.search['title'] = $('#Wz_title').val();
                        d.search['city'] = $('#city').val();
                        d.search['xid'] = $('#Xm_id').val();
                        d.search['author'] = $('#Wz_author').val();
                        d.search['date'] = $('#Wd_date').val();
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "id"},
                    {"data": "title"},
                    {"data": "created_at"},
                    {"data": "xid"},
                    {"data": "cate"},
                    {"data": "people"},
                    {"data": "area"},
                    {"data": "pt"},
                    {"data": "author"},
                    {"data": "status"},
                    {"data": "action"}
                ],
                columnDefs: [
                    {
                        'targets': -1, "render": function (data, type, row) {
                            var caozuo = '&nbsp;&nbsp;<a class="btn btn-xs btn-warning" href="/admin/question/' + row['id'] + '/edit" class="X-Small btn-xs text-success " title=" 编辑"><i class="fa fa-edit"></i></a>';
                            caozuo += '&nbsp;&nbsp;<a class="btn btn-xs btn-danger delBtn X-Small" href="#" attr="' + row['id'] + '"  title=" 删除"><i class="fa fa-trash-o"></i></a>';
                            
                            return caozuo;
                        }
                    },
                    {
                        'targets':10, "render": function (data, type, row) {
                         var bdstatus = "";
                         if(row['status']==1){
                             bdstatus = '<button type="button" class="btn btn-success btn-status" id="'+row['id']+'" rel="2">显示</button>';
                         }else{
                             bdstatus = '<button type="button" class="btn btn-danger btn-status" id="'+row['id']+'" rel="1">隐藏</button>';
                         }
                        return bdstatus;
                        }
                    }
                ]
            });

            table.on('preXhr.dt', function () {
                loadShow();
            });

            table.on('draw.dt', function () {
                loadFadeOut();
            });

            table.on('order.dt search.dt', function () {
                table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            
            $("table").delegate('.delBtn', 'click', function () {
                var id = $(this).attr('attr');
                $('.deleteForm').attr('action', '/admin/question/' + id);
                $("#modal-delete").modal();
            });
            $("table").delegate('.btn-status', 'click', function () {
                var id = $(this).attr('id');
                var status = $(this).attr('rel');
                if(status==1){
                    $('.lead').html('<i class="fa fa-question-circle fa-lg"></i>确认要显示吗?');
                }else{
                    $('.lead').html('<i class="fa fa-question-circle fa-lg"></i>确认要隐藏吗?');
                }
                $("input[name='status']").val(status);
                $('.deleteForm').attr('action', '/admin/question/' + id);
                $("#modal-delete").modal();
            });
            $('#Search_btn').click(function(){
                table.ajax.reload();
            });

        });
    </script>
@stop