
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
                    <option value="">审核状态</option>
                    <option value="0">未审核</option>
                    <option value="1">已审核</option>
                </select>
            </div>
             <div class="xm-sc">
                <select class="form-control" id="Sel_grade">
                    <option value="0">等级</option>
                    @if($gradeAll)
                    @foreach($gradeAll as $v)
                    <option  value="{{$v['id']}}">{{$v['name']}}</option>
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
                <input class="form-control" type="text" id="Xm_id"  placeholder="项目ID" />
            </div>
            <div class="xm-sc-txt">
                <input class="form-control" type="text" id="XM_name"  placeholder="项目名称" />
            </div>
            <div class="xm-sc-txt">
                <input class="form-control" type="text" id="Cp_name"  placeholder="公司名称" />
            </div>
            <div class="xm-sc">
                <button type="button" class="btn btn-success" id="Search_btn">查询</button>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <a href="/admin/xm/create" class="btn btn-success btn-md">
                <i class="fa fa-plus-circle"></i> 添加项目
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
                            <th>项目ID</th>
                            <th data-sortable="false">项目名称</th>
                            <th data-sortable="false">项目图片</th>
                            <th data-sortable="false">加盟店</th>
                            <th data-sortable="false">所属公司</th>
                            <th data-sortable="false">所属平台</th>
                            <th data-sortable="false">项目等级</th>
                            <th data-sortable="false">添加时间</th>
                            <th data-sortable="false">修改时间</th>
                            <th data-sortable="false">审核状态</th>
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
                        确认要删除这个分类吗?
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
                    url: '/admin/xm/index',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    "data": function ( d ) {
                       //添加额外的参数传给服务器
                        d.search['id'] = $('#Xm_id').val();
                        d.search['cate'] = $('#cate_F').val();
                        d.search['cates'] = $('#cate_S').val();
                        d.search['status'] = $('#Sel_status').val();
                        d.search['grade'] = $('#Sel_grade').val();
                        d.search['pt'] = $('#Sel_pt').val();
                        d.search['name'] = $('#XM_name').val();
                        d.search['cname'] = $('#Cp_name').val();
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "imgnum"},
                    {"data": "proxynum"},
                    {"data": "cid"},
                    {"data": "pt"},
                    {"data": "grade"},
                    {"data": "created_at"},
                    {"data": "updated_at"},
                    {"data": "status"},
                    {"data": "action"}
                ],
                columnDefs: [
                    {
                        'targets': -1, "render": function (data, type, row) {
                            var caozuo = '&nbsp;&nbsp;<a class="btn btn-xs btn-warning" href="/admin/xm/' + row['id'] + '/edit" class="X-Small btn-xs text-success " title=" 编辑"><i class="fa fa-edit"></i></a>';
                            caozuo += '&nbsp;&nbsp;<a class="btn btn-xs btn-danger delBtn X-Small" href="#" attr="' + row['id'] + '"  title=" 删除"><i class="fa fa-trash-o"></i></a>';
                            
                            return caozuo;
                        }
                    },
                    {
                        'targets':10, "render": function (data, type, row) {
                         var bdstatus = "";
                         if(row['status']==1){
                             bdstatus = '<button type="button" class="btn btn-success btn-status" id="'+row['id']+'" rel="2">已审核</button>';
                         }else{
                             bdstatus = '<button type="button" class="btn btn-danger btn-status" id="'+row['id']+'" rel="1">未审核</button>';
                         }
                        return bdstatus;
                        }
                    },
                    {
                        'targets':3, "render": function (data, type, row) {
                            var bdstatus = '<a href="/admin/pape/'+row['id']+'-2/create">编辑</a>';
                            return bdstatus;
                        }
                    },
                    {
                        'targets':4, "render": function (data, type, row) {
                            var bdstatus = '<a href="/admin/joinstore/'+row['id']+'">编辑</a>';
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
                $('.deleteForm').attr('action', '/admin/xm/' + id);
                $("#modal-delete").modal();
            });
            $("table").delegate('.btn-status', 'click', function () {
                var id = $(this).attr('id');
                var status = $(this).attr('rel');
                if(status==1){
                    $('.lead').html('<i class="fa fa-question-circle fa-lg"></i>确认要通过审核吗?');
                }else{
                    $('.lead').html('<i class="fa fa-question-circle fa-lg"></i>确认要禁用吗?');
                }
                $("input[name='status']").val(status);
                $('.deleteForm').attr('action', '/admin/xm/' + id);
                $("#modal-delete").modal();
            });
            $('#Search_btn').click(function(){
                table.ajax.reload();
            });

        });
    </script>
@stop