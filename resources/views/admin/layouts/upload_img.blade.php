<style>
    .thumb-wrap{
    overflow: hidden;
}
.thumb-wrap img{
    margin-top: 10px;
}
.pic-upload{
    width: 100%;
    height: 34px;
    margin-bottom: 10px;
}
#thumb-show{
    max-width: 100%;
    max-height: 300px;
}
.upload-mask{
    position: fixed;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.4);
    z-index: 1000;
}
.upload-file .close{
    cursor: pointer;
    font-size: 14px;
}

.upload-file{
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -105px;
    margin-left: -150px;
    max-width: 300px;
    z-index: 1001;
    display: none;
}

.upload-mask{
    display: none;
}
</style>
<!-- 上传图片div /S-->
<div class="upload-mask">
</div>
<div class="panel panel-info upload-file">
    <div class="panel-heading">
        上传图片
        <span class="close pull-right">关闭</span>
    </div>
    <div class="panel-body">
        <div id="validation-errors"></div>
        <form method="post" enctype="multipart/form- data" action="/admin/upload_img" id="imgForm">
        <div class="form-group">
            <label>图片上传</label>
            <span class="require">(*)</span>
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input id="thumb" name="file" type="file"  required="required">
            <input id="imgID"  type="hidden" name="id" value="">
            <input type="hidden" value="" id="upImg" name="ImgBs" />

        </div>
        </form>
    </div>
    <div class="panel-footer">
    </div>
</div>

<!-- 上传图片div /E-->