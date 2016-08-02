@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')


    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
            <div class="xm-sc-txt">
                  <input class="form-control" type="text" id="Str_id"  placeholder="店面ID" />
            </div>
            <div class="xm-sc-txt">
                <input class="form-control" type="text" value="" id="Xm_name"  placeholder="店面名称" />
            </div>

             <div class="xm-sc">
                <button type="button" class="btn btn-success" id="Search_btn">查询</button>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <a href="/admin/discount/{{$sid}}/create" class="btn btn-success btn-md">
                <i class="fa fa-plus-circle"></i> 添加优惠信息
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
                            <th class="hidden-sm">优惠ID</th>
                            <th data-sortable="false">优惠标题</th>
                            <th data-sortable="false">发布时间</th>
                            <th data-sortable="false">添加人</th>
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
    <input type="hidden" id="CID" value=""/>
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
                        确认要删除这个优惠信息吗?
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="deleteForm" method="POST" action="/admin/discount">
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
                    url: '/admin/discount/index/',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    "data": function ( d ) {
                       //添加额外的参数传给服务器
                        d.search['xname'] = $('#Xm_name').val();
                        d.search['sid'] = $('#Str_id').val();

                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "title"},
                    {"data": "addtime"},
                    {"data": "editor"},
                    {"data": "action"}
                ],
                columnDefs: [
                    {
                        'targets': -1, "render": function (data, type, row) {
                            var caozuo='';
                            caozuo += '&nbsp;&nbsp;<a class="btn btn-xs btn-warning" href="/admin/discount/' + row['id'] + '/edit" class="X-Small btn-xs text-success " title=" 编辑"><i class="fa fa-edit"></i></a>';
                            caozuo += '&nbsp;&nbsp;<a class="delBtn btn btn-xs btn-danger" href="#" attr="' + row['id'] + '" class="delBtn X-Small btn-xs text-danger " title=" 删除"><i class="fa fa-trash-o"></i></a>';
                            
                            return caozuo;
                        }
                    },


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

                           $('.deleteForm').attr('action', '/admin/discount/' + id);
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
               $('.deleteForm').attr('action', '/admin/discount/' + id);
               $("#modal-delete").modal();
           });
            $('#Search_btn').click(function(){
                table.ajax.reload();
            });

        });
    </script>
@stop