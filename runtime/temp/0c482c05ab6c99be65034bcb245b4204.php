<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"E:\laragon\www\h5\public/../application/basketball\view\guess\guess_list.html";i:1537945026;s:62:"E:\laragon\www\h5\application\basketball\view\public\meta.html";i:1537249833;s:64:"E:\laragon\www\h5\application\basketball\view\public\footer.html";i:1537249833;}*/ ?>
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

<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>查看赛程
    <span class="c-gray en">&gt;</span> 竞猜列表
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>

<div class="page-container">
    <div class="text-c">
        <button onclick="removeIframe()" class="btn btn-primary radius">关闭该页面</button>
        <input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
        <button type="submit" class="btn btn-success" id="phasegame_name" name="phasegame_name">
            <i class="Hui-iconfont">&#xe665;</i> 搜索
        </button>
    </div>
    <br><br>
    <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			 <a class="btn btn-danger radius"
                data-title="新加竞猜"
                data-href="<?php echo url('guess/guess',['game_id'=>$game_id,'game_number'=>$game_number]); ?>"
                onclick="Hui_admin_tab(this)" href="javascript:;">
                <i class="Hui-iconfont">&#xe600;</i> 新加竞猜
             </a>
        </span>
    </div>
    <?php endif; ?>

    <table class="table table-border table-bg">
        <thead>
        <tr class="text-c">
            <th>大赛名</th>
            <th>场次编号</th>
            <th>选手</th>
            <th>阶段名</th>
            <th>竞猜开始时间</th>
            <th>竞猜结束时间</th>
            <th>总投注</th>
            <th>胜/负注数</th>
            <th>单选详情</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
            <tr class="text-c">
                <td colspan="10">
                    当前比赛还没有添加竞猜
                </td>
            </tr>
        <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo $v['big_game_name']; ?></td>
            <td><?php echo $v['game_number']; ?></td>
            <td><?php echo $v['play_a_name']; ?>--<?php echo $v['play_b_name']; ?></td>
            <td><?php echo $v['phasegame_name']; ?></td>
            <td><?php echo date("Y-m-d H:i:s",$v['start_time']); ?></td>
            <td><?php echo date("Y-m-d H:i:s",$v['end_time']); ?></td>
            <td>0</td>
            <td>0</td>
            <td>查看单选</td>
            <td>
                <a class="btn btn-primary radius"
                   data-title="修改"
                   data-href="<?php echo url('guess/guess',['id'=>$v['id']]); ?>"
                   onclick="Hui_admin_tab(this)" href="javascript:;">
                    修改
                </a>
                <a href="javascript;" style="color: #2a58ee;font-size: 16px">已开启</a>
                <a href="javascript;" style="color: #2a58ee;font-size: 16px">关闭</a>
                <a href="javascript;" style="color: red;font-size: 16px">删除</a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>

        </tbody>
    </table>
</div>
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
<script type="text/javascript" src="/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    /*
        参数解释：
        title	标题
        url		请求的url
        id		需要操作的数据id
        w		弹出层宽度（缺省调默认值）
        h		弹出层高度（缺省调默认值）
    */
    /*球员或国家-增加*/
    function add(title,url,w,h)
    {
        layer_show(title,url,w,h);
    }
    /*管理员-删除*/
    function del(obj,id)
    {
        layer.confirm('确认要删除吗？',function(index)
        {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('gameLive/del'); ?>",
                dataType: 'json',
                data:{'id':id},
                success: function(result)
                {
                    if(result.status == 1)
                    {
                        $(obj).parents("tr").remove();
                        layer.msg(result.msg,{icon:1,time:2000});
                    }else{
                        layer.msg(result.msg,{icon:5,time:2000});
                    }
                },
                error:function(result) {
                    console.log(result.msg);
                },
            });
        });
    }

    /*管理员-编辑*/
    function edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*管理员-修改密码*/
    function change_password(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*停用*/
    function changeStatus(id,value,field,message)
    {
        layer.confirm(message,function(index)
        {
            //console.log(id);
            //console.log(value);   //status改变的值
            //console.log(field);   //要改变的字段
            $.ajax({
                type:'post',
                url:"<?php echo url('sport/changeStatus'); ?>",
                data:{'id':id,'field':'status','value':value},
                success:function(result)
                {
                    if(typeof result === 'string')
                    {
                        result = jQuery.parseJSON(result);
                    }
                    if(result.status == 1){
                        layer.msg(result.msg,{icon: 1,time:1000});
                        setInterval("loadPage()",1200);
                    }else{
                        layer.msg(result.msg,{icon:5,time:1000});
                    }
                }
            });
        });
    }
    function loadPage() {
        location.reload();
    }

    /*管理员-启用*/
    // function admin_start(obj,id){
    //     layer.confirm('确认要启用吗？',function(index){
    //         //此处请求后台程序，下方是成功后的前台处理……
    //         $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
    //         $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
    //         $(obj).remove();
    //         layer.msg('已启用!', {icon: 6,time:1000});
    //     });
    // }
</script>
</body>
</html>