$(function(){
    //上传图片相关

    $('.upload-mask').on('click',function(){
        $(this).hide();
        $('.upload-file').hide();
    })

    $('.upload-file .close').on('click',function(){
        $('.upload-mask').hide();
        $('.upload-file').hide();
    })

    var imgSrc = $('.pic-upload').next().attr('src');
//    console.log(imgSrc);
    if(imgSrc == ''){
        $('.pic-upload').next().css('display','none');
    }
    $('.pic-upload').on('click',function(){
        $('.upload-mask').show();
        $('.upload-file').show();
        $('#upImg').val($("#ImgBs").val());
        var imgID = $(this).next().attr('id');
        $('#imgID').attr('value',imgID);
    });
    $('#TK_btn').on('click',function(){
        var imgID = $('#img_id').val();
        if(imgID>=3){
            alert("证件已够!");
            return;
        }
        $('.upload-mask').show();
        $('.upload-file').show();
        $('#upImg').val($("#ImgBs").val());
        
        $("#img_id").val(parseInt(imgID)+1);
        var imgbtn = "tk_"+imgID;
        $('#imgID').attr('value',imgbtn);
    });
    $('#Xm_tk_btn').on('click',function(){
        var imgID = $('#img_id').val();
        var id = $("#id").val();
        var block = $("#block").val();
        var type = $("#xm_tk_type").val();
        if(type==0){
            alert("请选择图片类型");
            return;
        }else{
            $('.upload-mask').show();
            $('.upload-file').show();
            var str = block+"-"+type+"-"+id;
            $('#upImg').val(str);

            $("#img_id").val(parseInt(imgID)+1);
            var imgbtn = "tk_"+imgID;
            $('#imgID').attr('value',imgbtn);
        }
    });

    //ajax 上传
    $(document).ready(function() {
        var options = {
            beforeSubmit:  showRequest,
            success:       showResponse,
            dataType: 'json'
        };
        
        $('#imgForm input[name=file]').on('change', function(){
            //$('#upload-avatar').html('正在上传...');
            console.log(options);
            $('#imgForm').ajaxForm(options).submit();
        });
    });

    function showRequest() {
        $("#validation-errors").hide().empty();
        $("#output").css('display','none');
        return true;
    }

    function showResponse(response)  {
        if(response.success == false)
        {
            var responseErrors = response.errors;
            $.each(responseErrors, function(index, value)
            {
                if (value.length != 0)
                {
                    $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                }
            });
            $("#validation-errors").show();
        } else {
            if(response.type==2){
                location.reload();
                return;
            }
            $('.upload-mask').hide();
            $('.upload-file').hide();
            $('.pic-upload').next().css('display','block');

            $("#"+response.id).attr('src',response.pic);
            $("#"+response.id).next().attr('value',response.pic);
            $("#PicID").val(response.xid);
        }
    }
    
    /**
     * 删除公司图片
     * 
     */
    $('.tk_del').click(function(){
        var id = $(this).attr("id");
        $('.deleteForm').attr('action', '/admin/pape/' + id);
        $("#modal-delete").modal();
    });
    

})