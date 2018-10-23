<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"E:\laragon\www\h5\public/../application/ymq\view\batch_del\user_list.html";i:1538205336;s:55:"E:\laragon\www\h5\application\ymq\view\public\meta.html";i:1537249833;s:57:"E:\laragon\www\h5\application\ymq\view\public\footer.html";i:1537249833;}*/ ?>
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


<input type="button" onclick="delAll()" value="批量删除" />
<input type="button" onclick="che()" value="全选/反选" />
<table border="1" cellspacing="0" cellpadding="0" style="width: 80%" align="center">
    <tr>
        <td><input type="checkbox" onclick="cheAll()" id="che"></td>
        <td>姓名</td>
        <td>性别</td>
        <td>年龄</td>
        <td>操作</td>
    </tr>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><input type="checkbox" value="<?php echo $v['id']; ?>" id="ck" name="ck[]"></td>
        <td><?php echo $v['name']; ?></td>
        <td><?php echo $v['sex']; ?></td>
        <td><?php echo $v['age']; ?></td>
        <td>

            <input type="button" onclick="delAll()" value="删除" />
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</table>


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/admin/js/common.js"></script>

<!--引入uploadify上传的js文件-->
<script type="text/javascript" src="/static/admin/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/static/admin/js/image.js"></script>



<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    //全选
    function cheAll()
    {
        var cek = $("#che")[0].checked;
        var ck = $("input[name='ck[]']");
        for(var i = 0; i < ck.length; i++)
        {
            ck[i].checked = cek;
        }
    }

    //反选
    function che()
    {
        var cks = document.getElementsByName("ck[]");
        for(var i = 0; i < cks.length; i++)
        {
            cks[i].checked = !cks[i].checked;
        }
    }

    //批量删除
    function delAll()
    {
        var ck = $("input:checked[name='ck[]']");
        //获取到选中的input框的值
        var result = [];
        ck.each(function(){
            result.push($(this).val());
        })
        //console.log(result)
        if(ck.length == 0)
        {
            alert("请选择,然后进行删除");
            return;
        }
        layer.confirm('确认删除吗?',function(index)
        {
            $.ajax({
                type:'post',
                url:"<?php echo url('batchDel/del'); ?>",
                dataType:'json',
                data:{'ids':result},
                success:function(result)
                {
                    if(result.status == 1)
                    {
                        for(var i = 0; i < ck.length; i++)
                        {
                            ck[i].parentNode.parentNode.remove();
                        }
                        layer.msg(result.msg,{icon:1,time:2000});
                    }else{
                        layer.msg(result.msg,{icon:5,time:2000});
                    }
                }

            })
        })


      /*  var f=confirm("确认删除!!");
        if(!f){
            return;
        }
        for(var i = 0; i < ck.length; i++)
        {
            ck[i].parentNode.parentNode.remove();
        }*/
    }



</script>
