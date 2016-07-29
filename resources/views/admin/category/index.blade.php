
@extends('admin.layouts.base')

@section('title','控制面板')

@section('pageHeader','控制面板')

@section('pageDesc','DashBoard')

@section('content')
    <div class="row page-title-row" style="margin:5px;">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
            <a href="/admin/category/create" class="btn btn-success btn-md">
                <i class="fa fa-plus-circle"></i> 添加分类
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
                            <th data-sortable="false" class="hidden-sm">ID</th>
                            <th data-sortable="false">栏目名</th>
                            <th data-sortable="false">简拼</th>
                            <th class="hidden-sm">排序</th>
                            <th class="hidden-sm">状态</th>
                            <th class="hidden-md">创建日期</th>
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
                bLengthChange:false,
                order: [[1, "desc"]],
                serverSide: true,
                ajax: {
                    url: '/admin/category/index',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    "data": function ( d ) {
                       //添加额外的参数传给服务器
                        d.search['pid'] = $('#reportrange').val();
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "abbr"},
                    {"data": "seq"},
                    {"data": "status"},
                    {"data": "created_at"},
                    {"data": "action"}
                ],
                columnDefs: [
                    {
                        'targets': -1, "render": function (data, type, row) {
                            var caozuo = '<a href="javascript:void(0)" rel="'+row['id']+'" class="son_scan"><i class="fa fa-sliders" title="子级分类"></i> <span></span></a>';
                            caozuo += '&nbsp;&nbsp;<a href="/admin/category/' + row['id'] + '/edit" class="X-Small btn btn-xs btn-warning " title=" 编辑"><i class="fa fa-edit"></i></a>';
                            caozuo += '&nbsp;&nbsp;<a href="#" attr="' + row['id'] + '" class="delBtn btn btn-xs btn-danger " title=" 删除"><i class="fa fa-trash-o"></i></a>';
                            
                            return caozuo;
                        }
                    },
                    {
                        'targets':4, "render": function (data, type, row) {
                         var bdstatus = "";
                         if(row['status']==1){
                             bdstatus = '<button type="button" class="btn btn-success">已启用</button>';
                         }else{
                             bdstatus = '<button type="button" class="btn btn-link">已禁用</button>';
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
                $('.deleteForm').attr('action', '/admin/category/' + id);
                $("#modal-delete").modal();
            });
            $("#reportrange").on('apply.daterangepicker',function(){
                //当选择时间后，出发dt的重新加载数据的方法
                table.ajax.reload();
                //获取dt请求参数
                var args = table.ajax.params();
                console.log("额外传到后台的参数值extra_search为："+args.extra_search);
            });
             $("table").delegate('.son_scan','click',function(){
                 $("#reportrange").val($(this).attr('rel'));
                //当选择时间后，出发dt的重新加载数据的方法
                table.ajax.reload();
            });

        });
    </script>
@stop