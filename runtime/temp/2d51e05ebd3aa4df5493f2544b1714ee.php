<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"E:\laragon\www\h5\public/../application/boxing\view\big_game\big_game.html";i:1538028277;s:58:"E:\laragon\www\h5\application\boxing\view\public\meta.html";i:1537249833;s:60:"E:\laragon\www\h5\application\boxing\view\public\footer.html";i:1537249833;}*/ ?>
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


<h2 style="text-align:center; margin-top:20px;">
    <?php if(empty($one) || (($one instanceof \think\Collection || $one instanceof \think\Paginator ) && $one->isEmpty())): ?>
        添加大赛
    <?php else: ?>
        修改大赛
    <?php endif; ?>
</h2>

<div class="mt-20">
    <form id="add-bigGame" method="post" >
     <table class="table table-border table-hover" align="center" style="width: 80%" >
        <tbody>
        <tr class="text-c" style="line-height:60px">
            <td><strong>大赛名<span class="star">&nbsp;*</span></strong></td>
            <td>
                <input type="type" placeholder="大赛名" name="big_game_name" value="<?php echo $one['big_game_name']; ?>" style="width:60%;height:40px" class="input-text radius size-XL">
            </td>
            <td><strong>是否结束<span class="star">&nbsp;*</span></strong></td>
            <td>
                <span class="select-box size-XL radius mt-10">
                    <select  id="is_end" name="is_end" class="select" size="1">
                        <option value="">选择大赛状态</option>
                        <option value="1" <?php echo $one['is_end']==1?'selected' :''; ?>>未结束</option>
                        <option value="3" <?php echo $one['is_end']==3?'selected' :''; ?>>已结束</option>
                    </select>
                </span>
            </td>
        </tr>
        <!--<tr class="text-c" style="line-height: 60px">-->
            <!--<td><strong>大赛冠军<span class="star">&nbsp;*</span></strong></td>-->
            <!--<td>-->
                <!--<span class="select-box size-XL radius mt-10">-->
                 <!--<select  id="champion_id" name="champion_id" class="select">-->
                    <!--<option value="">选择一个参赛球员</option>-->

                    <!--<option value=""></option>-->

                 <!--</select>-->
                <!--</span>-->
            <!--<td><strong>比赛回放展示<span class="star">&nbsp;*</span></strong></td>-->
            <!--<td>-->
                <!--<span class="select-box size-XL radius mt-10">-->
                <!--<select  id="replay_status" name="replay_status" class="select">-->
                    <!--<option value="1">展示</option>-->
                    <!--<option value="2">不展示</option>-->
                <!--</select>-->
                <!--</span>-->
            <!--</td>-->
        <!--</tr>-->

        <!--属于哪个运动种类-->
        <tr class="text-c" style="line-height: 60px;display: none" >
            <td ><strong>种类<span class="star">&nbsp;*</span></strong></td>
            <td >
                 <span class="select-box size-XL radius mt-10">
                    <select  id="sport_id" name="sport_id" class="select" size="1">
                        <!--<option value="">请选择运动种类</option>-->
                        <option value="1">羽毛球</option>
                        <!--<option value="3">篮球</option>-->
                    </select>
                </span>
            </td>
        </tr>

        <tr class="text-c" style="line-height: 60px">
            <td ><strong>大赛宣传图</strong></td>
            <td colspan="3">
                <div style="margin-left: 100px">
                    <input id="file_upload"  type="file" multiple="true" >
                    <img style="display: none" id="upload_org_code_img" src="" width="150" height="150">   <!--上传成功后缩略图展示-->
                    <input id="file_upload_image" name="pic" type="hidden" multiple="true" value="">
                </div>
            </td>
        </tr>

        <!--<tr class="text-c" style="line-height: 60px">-->
            <!--<td ><strong>首页宣传图</strong></td>-->
            <!--<td colspan="3">-->
                <!--<div style="margin-left: 100px">-->
                    <!--<input id="file_uploads"  type="file" multiple="true" >-->
                    <!--<img style="display: none" id="upload_org_code_imgs" src="" width="150" height="150">   &lt;!&ndash;上传成功后缩略图展示&ndash;&gt;-->
                    <!--<input id="file_upload_images" name="image" type="hidden" multiple="true" value="">-->
                <!--</div>-->
            <!--</td>-->
        <!--</tr>-->
        <tr class="text-c" style="line-height: 60px">
            <td colspan="4">
                <div>
                    <input hidden value="<?php echo $one['id']; ?>" name="id">
                    <!--<button type="button" class="btn btn-success radius size-XL" onclick="history.go(-1)"> < </button>-->

                        <button onClick="removeIframe();" class="btn btn-success radius size-XL" type="button">&nbsp;&nbsp;<&nbsp;</button>

                    <button type="submit" class="btn btn-primary radius size-XL">提交</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
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
    $(function(){
        $('#add-bigGame').validate({
            rules:{
                big_game_name:{
                    required:true,
                    minlength:2,
                    maxlength:16
                },
                is_end:{
                    required:true
                }
            },
            submitHandler:function(form)
            {
                var data = $(form).serialize();  //获取表单里的数据
                url = "<?php echo url('bigGame/bigGame'); ?>";
                $.post(url,data,function(result)
                {
                    if(result.code == 1)
                    {
                        layer.msg(result.msg,{icon:1, time:2000},function(){
                            self.location = result.data.jump_url;
                        });
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
<!--/self.location = result.data.jump_url;-->
<!--//window.location.href = result.data.jump_url;
location.href = result.data.jump_url-->

