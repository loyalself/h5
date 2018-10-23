<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"E:\laragon\www\h5\public/../application/ymq\view\collection\collection.html";i:1538018819;s:55:"E:\laragon\www\h5\application\ymq\view\public\meta.html";i:1537249833;s:57:"E:\laragon\www\h5\application\ymq\view\public\footer.html";i:1537249833;}*/ ?>
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
    <form class="form form-horizontal" id="form-admin-add" method="post">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频url：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $one['video_url']; ?>" placeholder=""  name="video_url" autocomplete="off">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $one['video_title']; ?>" placeholder=""  name="video_title" autocomplete="off">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频来源：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $one['video_source']; ?>" placeholder="" name="video_source" autocomplete="off">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>视频显示图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >

                <img
                        <?php if(empty($one) || (($one instanceof \think\Collection || $one instanceof \think\Paginator ) && $one->isEmpty())): ?>
                        style="display: none"
                        {/else}
                style="display: inline"
                <?php endif; ?>

                id="upload_org_code_img"
                src="<?php echo !empty($one['bitmap'])?$one['bitmap']:''; ?>"
                width="200" height="200">

                <input id="file_upload_image" name="bitmap" type="hidden" multiple="true" value="">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>解析方式：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div class="radio-box">
                    <input name="analysis_type" type="radio" id="sex-1" checked value="1">
                    <label for="sex-1">直接播放</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="sex-2" name="analysis_type" value="2">
                    <label for="sex-2">点亮解析</label>
                </div>
            </div>
        </div>

        <!--<div class="row cl">-->
            <!--<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>是否启用：</label>-->
            <!--<div class="formControls col-xs-8 col-sm-9">-->
                <!--<div class="radio-box">-->
                    <!--<input name="status" type="radio" id="sex-3" checked value="1">-->
                    <!--<label for="sex-3">启用</label>-->
                <!--</div>-->
                <!--<div class="radio-box">-->
                    <!--<input type="radio" id="sex-4" name="status" value="2">-->
                    <!--<label for="sex-4">禁用</label>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->

        <!--<div class="row cl">-->
            <!--<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>跳转类型：</label>-->
            <!--<div class="formControls col-xs-8 col-sm-9">-->
                <!--<span class="select-box" style="width:150px;">-->
			<!--<select class="select" name="redirect_type" size="1" >-->
					<!--<option value>请选择跳转类型</option>-->
					<!--<option value=0>直播室</option>-->
					<!--<option value=1>集锦详情</option>-->
					<!--<option value=2>资讯详情</option>-->
					<!--<option value=3>活动页H5</option>-->
			<!--</select>-->
			<!--</span>-->
            <!--</div>-->
        <!--</div>-->

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input hidden value="" name="id">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-admin-add").validate({
            rules:{
                username:{
                    required:true,
                    minlength:4,
                    maxlength:16
                },
                password:{
                    required:true,
                },
                adminRole:{
                    required:true,
                },
            },

            submitHandler:function(form)
            {
                var data = $(form).serialize();  //获取表单里的数据
                url = $(form).attr('url');
                $.post(url,data,function(result)
                {
                    if(result.code == 1)   //添加成功
                    {
                        layer.msg(result.msg,{icon:1,time:2000});
                        setInterval("closeWindow()",2000);
                    }else{
                        layer.msg(result.msg,{icon:5,time:2000});
                    }
                },'JSON')
            }
        });
    });
    function closeWindow()
    {
        var index = parent.layer.getFrameIndex(window.name);
        window.parent.location.reload();
    }
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>