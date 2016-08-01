$(function(){
     $('.xm_type').click(function(){
         var str = $(this).attr("class").split(" ")[1];
         if(str=='btn-default'){
             $('.xm_type').attr("class",'btn btn-default xm_type');
             $(this).attr("class",'btn btn-primary xm_type');
             $("#xm_type").val($(this).val());
         }
    });
     $('.zx_type').click(function(){
         var str = $(this).attr("class").split(" ")[1];
         if(str=='btn-default'){
             $('.zx_type').attr("class",'btn btn-default zx_type');
             $(this).attr("class",'btn btn-primary zx_type');
             $("#zx_type").val($(this).val());
         }
    });
     $('.status').click(function(){
         var str = $(this).attr("class").split("  ")[1];
         if(str=='btn-default'){
             $('.status').attr("class",'btn  btn-default  status');
             $(this).attr("class",'btn  btn-primary  status');
             $("#status").val($(this).val());
         }
    });
})


