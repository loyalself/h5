<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"/www/h5/public/../application/ymq/view/information/add.html";i:1538298778;s:45:"/www/h5/application/ymq/view/public/meta.html";i:1537249833;s:47:"/www/h5/application/ymq/view/public/footer.html";i:1537249833;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/static/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/static/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />


    <!--引入上传插件uploadify的css样式-->
    <link rel="stylesheet" type="text/css" href="/static/admin/uploadify/uploadify.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <!--uploadify插件上传图片配置-->
    <script type="text/javascript">
        swf = '/static/admin/uploadify/uploadify.swf';
        image_upload_url = "<?php echo url('image/upload'); ?>";
    </script>
    <title>H5</title>
<body>

<article class="page-container">
    <form url="<?php echo url('information/add'); ?>" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>新闻类型：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <select  class="select" name="content_type" size="1">
                    <option value>请选择新闻类型</option>
                    <option value=0 <?php echo $one['content_type']===0?'selected':''; ?>>一张图</option>
                    <option value=1 <?php echo $one['content_type']==1?'selected':''; ?>>三张图</option>
                    <option value=2 <?php echo $one['content_type']==2?'selected':''; ?>>视频</option>
                </select>
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>新闻标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $one['title']; ?>" placeholder="" id="title" name="title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>新闻作者：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $one['author']; ?>" placeholder="" id="author" name="author">
            </div>
        </div>
       <!-- <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">新闻来源：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="0" placeholder="" id="sources" name="sources">
            </div>
        </div>-->

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">新闻图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >

                <img style="display: none"
                     id="upload_org_code_img"
                     <?php if(empty($one) || (($one instanceof \think\Collection || $one instanceof \think\Paginator ) && $one->isEmpty())): ?>
                     src=""
                     <?php else: ?>
                     src="<?php echo $one['img_url']; ?>"
                     <?php endif; ?>
                     width="300" height="300">   <!--上传成功后缩略图展示-->


                <input id="file_upload_image" name="img_url" type="hidden" multiple="true" value="">
            </div>
        </div>
        <!--新闻展示图2-->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"></label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="file_uploads"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_imgs"
                     <?php if(empty($one) || (($one instanceof \think\Collection || $one instanceof \think\Paginator ) && $one->isEmpty())): ?>
                     src=""
                     <?php else: ?>
                     src="<?php echo $one['img_url2']; ?>"
                    <?php endif; ?>
                     width="300" height="300">   <!--上传成功后缩略图展示-->
                <input id="file_upload_images" name="img_url2" type="hidden" multiple="true" value="">
            </div>
        </div>

        <!--新闻展示图3-->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"></label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="file_uploadsa"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_imgsa" src="" width="300" height="300">   <!--上传成功后缩略图展示-->
                <input id="file_upload_imagesa" name="img_url3" type="hidden" multiple="true" value="">
            </div>
        </div>

        <!--关于视频上传-->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">视频上传</label>
            <div class="formControls col-xs-8 col-sm-9">
               <!-- <span class="c-red">*</span>视频url：
                <input type="text" class="input-text" value="" placeholder="" id="video_url" name="video_url">-->
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频url：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="video_url" name="video_url">
            </div>
        </div>
        <div class="mt-20 skin-minimal">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频解析方式：</label>
            <div class="radio-box">
                <input type="radio" id="radio-1" name="analysis_type" value="1" checked>
                <label for="radio-1">直接播放</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="radio-2" name="analysis_type" value="2" >
                <label for="radio-2">点亮解析</label>
            </div>
        </div>
        <!--视频封面-->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频封面：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="file_uploadsv"  type="file" multiple="true" >
                <img style="display: none" id="upload_org_code_imgsv" src="" width="300" height="300">   <!--上传成功后缩略图展示-->
                <input id="file_upload_imagesv" name="bitmap" type="hidden" multiple="true" value="">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频来源：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="video_source" name="video_source">
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">新闻内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor" type="text/plain" name="content" style="width:100%;height:400px;"></script></div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button  class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</article>

<!--_footer 作为公共模版分离出去-->
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/admin/js/common.js"></script>

<!--引入uploadify上传的js文件-->
<script type="text/javascript" src="/static/admin/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/static/admin/js/image.js"></script>



<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/static/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    $(function(){
                        $('.skin-minimal input').iCheck({
                            checkboxClass: 'icheckbox-blue',
                            radioClass: 'iradio-blue',
                            increaseArea: '20%'
                        });

                        //表单验证
                        $("#form-article-add").validate({
                            rules:{
                                content_type:{
                                  required:true
                                },
                                title:{
                                    required:true,
                                    minlength:3,
                                    maxlength:25
                                },
                                author:{
                                    required:true,
                                    minlength:2,
                                    maxlength:6
                                },
                                content:{
                                    required:true,
                                },
                                articletype:{
                                    required:true,
                                },
                            },
                            onkeyup:false,
                            focusCleanup:true,
                            success:"valid",
                            submitHandler:function(form){
                                //$(form).ajaxSubmit();
                               // var index = parent.layer.getFrameIndex(window.name);
                                //parent.$('.btn-refresh').click();
                                //parent.layer.close(index);
                                add_save(form)
                            }
                        });

                        $list = $("#fileList"),
                            $btn = $("#btn-star"),
                            state = "pending",
                            uploader;

                        var uploader = WebUploader.create({
                            auto: true,
                            swf: 'lib/webuploader/0.1.5/Uploader.swf',

                            // 文件接收服务端。
                            server: 'fileupload.php',

                            // 选择文件的按钮。可选。
                            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                            pick: '#filePicker',

                            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                            resize: false,
                            // 只允许选择图片文件。
                            accept: {
                                title: 'Images',
                                extensions: 'gif,jpg,jpeg,bmp,png',
                                mimeTypes: 'image/*'
                            }
                        });
                        uploader.on( 'fileQueued', function( file ) {
                            var $li = $(
                                '<div id="' + file.id + '" class="item">' +
                                '<div class="pic-box"><img></div>'+
                                '<div class="info">' + file.name + '</div>' +
                                '<p class="state">等待上传...</p>'+
                                '</div>'
                                ),
                                $img = $li.find('img');
                            $list.append( $li );

                            // 创建缩略图
                            // 如果为非图片文件，可以不用调用此方法。
                            // thumbnailWidth x thumbnailHeight 为 100 x 100
                            uploader.makeThumb( file, function( error, src ) {
                                if ( error ) {
                                    $img.replaceWith('<span>不能预览</span>');
                                    return;
                                }

                                $img.attr( 'src', src );
                            }, thumbnailWidth, thumbnailHeight );
                        });
                        // 文件上传过程中创建进度条实时显示。
                        uploader.on( 'uploadProgress', function( file, percentage ) {
                            var $li = $( '#'+file.id ),
                                $percent = $li.find('.progress-box .sr-only');

                            // 避免重复创建
                            if ( !$percent.length ) {
                                $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
                            }
                            $li.find(".state").text("上传中");
                            $percent.css( 'width', percentage * 100 + '%' );
                        });

                        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
                        uploader.on( 'uploadSuccess', function( file ) {
                            $( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
                        });

                        // 文件上传失败，显示上传出错。
                        uploader.on( 'uploadError', function( file ) {
                            $( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
                        });

                        // 完成上传完了，成功或者失败，先删除进度条。
                        uploader.on( 'uploadComplete', function( file ) {
                            $( '#'+file.id ).find('.progress-box').fadeOut();
                        });
                        uploader.on('all', function (type) {
                            if (type === 'startUpload') {
                                state = 'uploading';
                            } else if (type === 'stopUpload') {
                                state = 'paused';
                            } else if (type === 'uploadFinished') {
                                state = 'done';
                            }

                            if (state === 'uploading') {
                                $btn.text('暂停上传');
                            } else {
                                $btn.text('开始上传');
                            }
                        });

                        $btn.on('click', function () {
                            if (state === 'uploading') {
                                uploader.stop();
                            } else {
                                uploader.upload();
                            }
                        });

                        var ue = UE.getEditor('editor');

                    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
