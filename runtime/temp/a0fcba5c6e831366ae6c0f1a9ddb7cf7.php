<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"/www/h5/public/../application/ymq/view/admin_role_group/role.html";i:1537249833;s:45:"/www/h5/application/ymq/view/public/meta.html";i:1537249833;s:47:"/www/h5/application/ymq/view/public/footer.html";i:1537249833;}*/ ?>
﻿<!DOCTYPE HTML>
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
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $one['groupname']; ?>" placeholder="" id="roleName" name="groupname">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">分组描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text"
					   id=""
					   name="remark"
					   class="input-text" value="<?php echo $one['remark']; ?>" placeholder="请输入角色分组的描述信息，不超过255个字符">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否启用：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="status" type="radio" id="radio-1"  value="1" <?php echo $one['status'] == 1 ? 'checked':''?>>
					<label for="radio-1">启用</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="radio-2" name="status" value="0" <?php echo $one['status'] == 0 ? 'checked':''?>>
					<label for="radio-2">禁用</label>
				</div>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">角色权限：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php foreach($list as $k=>$v){ ?>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox"
								   value="<?php echo $v[0]['p_id']?>"
								   name="ids[]" id="user-Character-1"
							<?php echo in_array($v[0]['p_id'],explode(',',$one['rules'])) ? 'checked':'' ?>>
							<?php echo $k;?>
						</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dd>
								<?php foreach($v as $v1){ ?>
								<label class="">
									<input type="checkbox"
										   value="<?php echo $v1['id']?>"
										   name="ids[]" id="user-Character-1-0-0"
									<?php echo in_array($v1['id'],explode(',',$one['rules'])) ? 'checked':'' ?>>
									<?php echo $v1['title']?>
								</label>
								<?php }?>
							</dd>
						</dl>
					</dd>
				</dl>
				<?php }?>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input type="hidden" value="<?php echo $one['id']?>" name="id">
				<button type="submit" class="btn btn-success radius" id="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

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
        $(".permission-list dt input:checkbox").click(function(){
            $(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
        });
        $(".permission-list2 dd input:checkbox").click(function(){
            var l =$(this).parent().parent().find("input:checked").length;
            var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
            if($(this).prop("checked")){
                $(this).closest("dl").find("dt input:checkbox").prop("checked",true);
                $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
            }
            else{
                if(l==0){
                    $(this).closest("dl").find("dt input:checkbox").prop("checked",false);
                }
                if(l2==0){
                    $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
                }
            }
        });

        $("#form-admin-role-add").validate({
            rules:{
                groupname:{
                    required:true,
                },
            },
            onkeyup:false,
            focusCleanup:true,
            success:"valid",
            submitHandler:function(form)
            {
                var data = $(form).serialize();
                url = "<?php echo url('adminRoleGroup/role'); ?>";
                $.post(url,data,function(result)
                {
                    if(result.status == 1)
                    {
                        layer.msg(result.msg,{icon:1,time:2000});
                        setInterval("closeWindow()",2000);
                    }else{
                        layer.msg(result.msg,{icon:5,time:2000});
                    }
                },'JSON');
            }
        });
    });
    function closeWindow(){
        var index = parent.layer.getFrameIndex(window.name);
        window.parent.location.reload();
    }
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>