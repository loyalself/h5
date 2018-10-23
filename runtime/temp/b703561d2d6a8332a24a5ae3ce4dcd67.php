<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\laragon\www\h5\public/../application/ymq\view\login\index.html";i:1537249833;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link href="/static/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/static/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="/static/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>H5后台登录</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">

        <form class="form form-horizontal" method="post" id="formcheck">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="username"
                           name="username"
                           type="text"
                           placeholder="用户名"
                           class="input-text size-L"
                    >

                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>

            <!--<div class="row cl">
              <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
              <div class="formControls col-xs-8">
                <input id="confirm-password" name="confirm-password" type="password" placeholder="确认密码" class="input-text size-L">
              </div>
            </div>-->

            <!--<div class="row cl">
              <div class="formControls col-xs-8 col-xs-offset-3">
                &lt;!&ndash;<input class="input-text size-L" type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">&ndash;&gt;
                <input class="input-text size-L" type="text" placeholder="验证码"  name="code" value="" style="width:150px;">
                <img src="/captcha" title="看不清请点击换一张" onclick="reloadcode(this)"> &lt;!&ndash;<a id="kanbuq" href="javascript:;">看不清，换一张</a>&ndash;&gt; </div>
            </div>-->

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <!-- <label for="online">
                       <input type="checkbox" name="online" id="online" value="">
                       使我保持登录状态
                     </label>-->
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin v3.1</div>
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script>
    //看不清请点击换一张验证码
    /*
      function reloadcode(obj)
      {
          obj.src="/captcha?id=" + Math.random()
      }
    */


    $(document).ready(function(){
        $("#formcheck").validate({
            //debug:true,        //只进行校验,不进行表单提交
            rules:{
                username:{     //这里的username是input框里的name属性值
                    required:true,
                    minlength:3,               //这个代表长度
                    maxlength:16,
                    //rangelength:[3,16],     //输入的数据范围
                    //min:  max:              //针对数字的值
                    //email:true              //必须是email格式
                    //date:true               //日期格式
                    //dateISO:true           // 年-月-日
                    //number:true           //只要数字
                    //digits:true           //必须是一个非负整数
                    //equalTo
                    /* remote: {         //远程校验  get请求/post都可以，跟上要请求验证数据的url地址
                         url:'',
                         type:'POST',
                         data:{

                         }
                     }*/
                },
                password:{
                    required:true,
                    minlength:5,
                    maxlength:16
                },
                //确认输入密码
                /*"confirm-password":{
                   equalTo:'#password'
                }*/
            },
            messages:{
                username:{
                    required:'请输入用户名',
                    minlength:'用户名最小为3位',
                    maxlength:'用户名最大为16位',
                    //rangelength:'用户名应该在3-16位之间',
                    //min:  max:              //针对数字
                    //email:格式不对
                    remot:'该用户名不存在'
                },
                password:{
                    required:'请输入密码',
                    minlength:'密码最小为5位',
                    maxlength:'密码最大为16位'
                },
                /* "confirm-password":{
                     equalTo:'两次输入的密码不一致'
                 }*/
            },
            submitHandler:function(form)
            {
                var data = $(form).serialize();
                url = "<?php echo url('login/login'); ?>";

                $.post(url,data,function(result)
                {
                    if(result.status == 1)
                    {
                        layer.msg(result.msg,{icon:1,time:2000});
                        setInterval("jump()",1000);
                    }else{
                        layer.msg(result.msg,{icon:5,time:2000});
                    }
                },'JSON')
            }
        })
    });
    function jump(){
        location.href = "/ymq/index/index.html";
    }
</script>

</body>
</html>