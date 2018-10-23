<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"E:\laragon\www\h5\public/../application/ymq\view\sport\sport.html";i:1537249833;s:55:"E:\laragon\www\h5\application\ymq\view\public\meta.html";i:1537249833;s:57:"E:\laragon\www\h5\application\ymq\view\public\footer.html";i:1537249833;}*/ ?>
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
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>运动名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $one['sport_name']; ?>" placeholder="请输入运动种类名称" id="adminName" name="sport_name">
            </div>
        </div>

        <!--<div class="row cl">-->
            <!--<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否展示：</label>-->
            <!--<div class="formControls col-xs-8 col-sm-9 skin-minimal">-->
                <!--<div class="radio-box">-->
                    <!--<input name="status" type="radio" id="sex-1" checked value="0">-->
                    <!--<label for="sex-1">展示</label>-->
                <!--</div>-->
                <!--<div class="radio-box">-->
                    <!--<input type="radio" id="sex-2" name="status" value="1">-->
                    <!--<label for="sex-2">屏蔽</label>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->


        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input hidden value="<?php echo $one['id']; ?>" name="id">
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
                sportname:{
                    required:true,
                    minlength:2,
                    maxlength:16
                },
            },
            submitHandler:function(form)
            {
                var data = $(form).serialize();  //获取表单里的数据
                url = "<?php echo url('sport/sport'); ?>";
                $.post(url,data,function(result)
                {
                    if(result.status == 1)   //添加成功
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

</body>
</html>