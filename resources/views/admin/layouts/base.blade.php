
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') | QudaoCMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="_token" content="{{ csrf_token() }}"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/bootstrap/css/jquery.autocomplete.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="/dist/css/skins/skin-blue.min.css">
<link href="/dist/date/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="all" href="/dist/date/daterangepicker-bs3.css" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  {{--dataTabels--}}
  {{--<link href="/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">--}}
  <link href="/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">

  {{--loding--}}
  <link href="/dist/css/load/load.css" rel="stylesheet">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="loading">
  <div id="loading-center">
    <div id="loading-center-absolute">
      <div class="object" id="object_four"></div>
      <div class="object" id="object_three"></div>
      <div class="object" id="object_two"></div>
      <div class="object" id="object_one"></div>
    </div>
  </div>
</div>
<div class="wrapper">

  <!-- Main Header -->
  @include('admin.layouts.mainHeader')
  <!-- Left side column. contains the logo and sidebar -->
  @include('admin.layouts.mainSidebar')
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('pageHeader')
        <small>@yield('pageDesc')</small>
      </h1>
      <ol class="breadcrumb">
        {!! Breadcrumbs::render(Route::currentRouteName()) !!}
      </ol>
      
    </section>

    <!-- Main content -->
    <section class="content">

	  @yield('content')
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.0 -->
<script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/app.min.js"></script>

<!-- dataTables -->
<script src="/plugins/datatables/jquery.dataTables.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="/dist/js/common.js"></script>
<script src="/dist/js/cate.js"></script>
<script src="/dist/js/jquery.form.js"></script>
<script src="/bootstrap/js/upload.js"></script>
<script src="/dist/bu/js/fileinput.js"></script>
<script src="/dist/bu/js/fileinput_locale_zh.js"></script>
<script src="/bootstrap/js/moreupload.js"></script>
<script type="text/javascript" charset="utf-8" src="/dist/uedit/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/dist/uedit/umeditor.min.js"></script>
<script type="text/javascript" src="/dist/uedit/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="/dist/date/moment.js"></script>
<script type="text/javascript" src="/dist/date/daterangepicker.js"></script>
<script>
    var um = UM.getEditor('myEditor');
   
    var um2 = UM.getEditor('conditions');
    
    var um3 = UM.getEditor('xmdesc');
    
    var um4 = UM.getEditor('advantage');
    
    var um5 = UM.getEditor('policies');
    
    var um6 = UM.getEditor('analysis');
    
    
    
    $("#province").change(function(){
        var province = $(this).val();
        var token = $("input[name='_token']").val();
        if(province>0){
            $.post('/admin/company/region',{id:province,_token:token},function(res){
                $("#city").html(res.str);
            },'json');
        }
    });
    
    $("#company_name").blur(function(){
        var keyword = $(this).val();
        var token = $("input[name='_token']").val();
        $.post("/admin/company/show",{keyword:keyword,_token:token},function(res){
            if(res.num>0){
                $('#name_error').html("公司名已存在");
            }else{
                $('#name_error').html("");
            }
        },'json');
    });
    
    
    $("#cate_F").change(function(){
        var pid = $(this).val();
        var token = $("input[name='_token']").val();
        $('#pid').val(pid);
        $('#pids').val(pid+",0");
        $("#grade").val(2);
        if(pid>0){
            $.post('/admin/category/cateson',{id:pid,_token:token},function(res){
                $("#cate_S").html(res.str);
            },'json');
        }
    });
    $("#cate_S").change(function(){
        var pid = $(this).val();
        var pids = $('#pids').val();
        $('#pid').val(pid);
        $('#pids').val(pid+','+pids);
        $("#grade").val(3);
    });
</script>


<script type="text/javascript">
$(document).ready(function() {
   $('#birthday').daterangepicker({
       startDate:"2016-01-01",
       singleDatePicker: true,
       dateFormat: 'yy-mm-dd',
       showDropdowns: true
   }, function(start, end, label) {
//     console.log(start.toISOString(), end.toISOString(), label);
   });
   $('.birthday').daterangepicker({
       startDate:"2016-01-01",
       singleDatePicker: true,
       dateFormat: 'yy-mm-dd',
       showDropdowns: true
   }, function(start, end, label) {
//     console.log(start.toISOString(), end.toISOString(), label);
   });
   $('.wzbirthday').daterangepicker({
       startDate:"2016-01-01",
       singleDatePicker: false,
       dateFormat: 'yy-mm-dd',
       showDropdowns: true
   }, function(start, end, label) {
//     console.log(start.toISOString(), end.toISOString(), label);
   });
});
//操作复选框所属平台
$('.pt_ck').click(function(){
    var pt = "";
    $("#pt_ck label input[type=checkbox]").each(function(){
        if(this.checked){
            pt +=$(this).val()+',';
        }
    });
    pt=pt.substring(0,pt.length-1);
    $("input[name=pt]").val(pt);
}); 
//操作复选框投资选址
$('.locat_ck').click(function(){
    var pt = "";
    $("#locat_ck label input[type=checkbox]").each(function(){
        if(this.checked){
            pt +=$(this).val()+',';
        }
    });
    pt=pt.substring(0,pt.length-1);
    $("input[name=locat]").val(pt);
}); 
//操作复选框适合人群
$('.crowd_ck').click(function(){
    var pt = "";
    $("#crowd_ck label input[type=checkbox]").each(function(){
        if(this.checked){
            pt +=$(this).val()+',';
        }
    });
    pt=pt.substring(0,pt.length-1);
    $("input[name=crowd]").val(pt);
});
/**
 * 招商地区
 * @returns {undefined}
 */
$("#btnAddProvince").click(function(){
    $("#dialog_selectProvince").modal();
});
$('#zsarea_ck').click(function(){
    var pt = "";
    var str = "";
    $(".modal-body div input[type=checkbox]").each(function(){
        if(this.checked){
            pt +=$(this).val()+',';
            str += '<button type="button" class="btn btn-link">'+$(this).attr('title')+'</button>';
        }
    });
    pt=pt.substring(0,pt.length-1);
    $("input[name=zsarea]").val(pt);
    $('#zsarea_xz').html(str);
    $("#dialog_selectProvince").modal('hide');
});

//操作文章所属平台
$('.pt_art_ck').click(function(){
    var id = $(this).val();
    var token = $("input[name='_token']").val();
    $.post('/admin/category/cateson',{id:id,_token:token},function(res){
        $("#Columns").html(res.str);
    },'json');
}); 
//操作文章所属平台
$('#Sel_pt').change(function(){
    var id = $(this).val();
    var token = $("input[name='_token']").val();
    $.post('/admin/category/cateson',{id:id,_token:token},function(res){
        $("#Columns").html(res.str);
    },'json');
});
</script>

<script>
    //选项卡
   $(function () {
      $('#myTab li:eq(0) a').tab('show');
   });
   
</script>
<script src="/bootstrap/js/jquery.autocomplete.js"></script>
<script>
function searcharea(){
   var a = $('#search_cm').autocomplete({
       serviceUrl:'/admin/company/ajax',
       minChars:1,
       delimiter: /(,|;)\s*/, // regex or character
       maxHeight:400,
       width:300,
       zIndex: 9999,
       deferRequestBy: 2, //miliseconds
       //params: {country:'Yes'}, //aditional parameters
       noCache: false, //default is false, set to true to disable caching
       // callback function:
       onSelect: function(value, data){
            $("#search_cm").val(data.id);
          }
       });
 }

 $(function(){
    searcharea();

    $("#ipts").change(function(){
       $("#search_cm").val('');
    });

 });
 
 //品牌ID
function searchxm(){
   
   var a = $('#search_xm').autocomplete({
       serviceUrl:'/admin/xm/ajax',
       minChars:1,
       delimiter: /(,|;)\s*/, // regex or character
       maxHeight:400,
       width:300,
       zIndex: 9999,
       deferRequestBy: 2, //miliseconds
       //params: {country:'Yes'}, //aditional parameters
       noCache: false, //default is false, set to true to disable caching
       // callback function:
       onSelect: function(value, data){
            $("#search_xm").val(data.id);
            var pt = $("input[name='pt']:checked").val();
            var sear=new RegExp(pt);
            if(sear.test(data.pt))
            {
                $("#xiderr").text('*');
            }else{
                $("#xiderr").text('此项目没有在选择的平台内');
            }

          }
       });
 }

 $(function(){
    searchxm();

    $("#search_xm").change(function(){
       $(this).val('');
    });

 });
</script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
@yield('js')
        <!-- Main Footer -->
@include('admin.layouts.mainFooter')
</body>
</html>
