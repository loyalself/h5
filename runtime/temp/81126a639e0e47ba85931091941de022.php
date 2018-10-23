<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"E:\laragon\www\h5\public/../application/ymq\view\star\star.html";i:1537957418;s:55:"E:\laragon\www\h5\application\ymq\view\public\meta.html";i:1537249833;s:57:"E:\laragon\www\h5\application\ymq\view\public\footer.html";i:1537249833;}*/ ?>
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

<div class="page-container">
    <form  method="post" class="form form-horizontal" id="add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>中文名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $one['c_name']; ?>"
                       placeholder="请输入中文名称" id="c_name" name="c_name"
                       autocomplete="off">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">英文名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $one['e_name']; ?>"
                       autocomplete="off"
                       placeholder="请输入英文名称" id="e_name" name="e_name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input id="file_upload"  type="file" multiple="true" >

                <img
                        <?php if(empty($one) || (($one instanceof \think\Collection || $one instanceof \think\Paginator ) && $one->isEmpty())): ?>
                            style="display: none"
                        {/else}
                            style="display: inline"
                        <?php endif; ?>

                     id="upload_org_code_img"
                     src="<?php echo !empty($one['pic'])?$one['pic']:''; ?>"
                     width="200" height="200">   <!--上传成功后缩略图展示-->

                <input id="file_upload_image" name="pic" type="hidden" multiple="true" value="<?php echo $one['pic']; ?>">
            </div>

        </div>

        <div class="mt-20 skin-minimal">
            <label class="form-label col-xs-4 col-sm-2">性别：</label>

            <div class="radio-box">
                <input type="radio" id="radio-1" name="gender"
                       <?php echo $one['gender']==1?'checked' : ''; ?>
                       value="1" checked >
                <label for="radio-1">男</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="radio-2" name="gender"
                       <?php echo $one['gender']==2?'checked' : ''; ?>
                       value="2">
                <label for="radio-1">女</label>
            </div>
            <div class="radio-box">
                <input type="radio" id="radio-3" name="gender"
                       <?php echo $one['gender']==3?'checked' : ''; ?>
                       value="3">
                <label for="radio-1">无</label>
                <span style="color: #bd362f">(注:若是国家,请选择无)</span>
            </div>
        </div>

        <div class="row cl">
                <div class="row cl">
                    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <input hidden value="<?php echo $one['id']; ?>" name="id">
                    <button class="btn btn-primary radius" type="submit">
                        <i class="Hui-iconfont">&#xe632;</i> 保存
                    </button>
                    <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                    </div>
                </div>
        </div>
    </form>
</div>

               <!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/admin/js/common.js"></script>

<!--引入uploadify上传的js文件-->
<script type="text/javascript" src="/static/admin/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/static/admin/js/image.js"></script>



<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
                <script type="text/javascript">
                  $(function ()
                  {
                      $('#add').validate({
                          rules:{
                              c_name:{
                                  required:true,
                                  maxlength:10
                              },
                          },
                          submitHandler:function(form)
                          {
                              var data = $(form).serialize();
                              url = "<?php echo url('star/star'); ?>";
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