<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"E:\laragon\www\h5\public/../application/taiqiu\view\big_game\big_game_list.html";i:1538028510;s:58:"E:\laragon\www\h5\application\taiqiu\view\public\meta.html";i:1537249833;s:60:"E:\laragon\www\h5\application\taiqiu\view\public\footer.html";i:1537249833;}*/ ?>
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

<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i>首页
    <span class="c-gray en">&gt;</span> 台球赛事管理
    <span class="c-gray en">&gt;</span> 台球赛程列表
    <a class="btn btn-success radius r"
       style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
    <div class="text-c">
        <button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>

        <input type="text" name="bigGame_name" id="bigGame_name" placeholder="请输入大赛名称" style="width:250px" class="input-text">
        <button name="" id="" class="btn btn-success" type="submit">
            <i class="Hui-iconfont">&#xe665;</i>
            搜索
        </button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <!--<span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>-->
        <a class="btn btn-primary radius"
           data-title="添加大赛"
           data-href="<?php echo url('bigGame/bigGame'); ?>"
           onclick="Hui_admin_tab(this)" href="javascript:;">
            <i class="Hui-iconfont">&#xe600;</i> 添加大赛
        </a>

        <!--<span class="r">共有数据：<strong>54</strong> 条</span> -->
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-responsive">
            <thead>
            <tr class="text-c">
               <!-- <th width="25"><input type="checkbox" name="" value=""></th>-->
                <th width="30">大赛编号</th>
                <th width="100">创建时间</th>
                <th width="120">大赛名</th>
                <th width="80">总投注数</th>
                <th width="80">总投注额</th>
                <th width="75">用户胜/负数</th>
                <th width="30">是否结束</th>
                <th width="150">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <tr class="text-c">
               <!-- <td><input type="checkbox" value="" name=""></td>-->
                <td><?php echo $v['id']; ?></td>
                <td><?php echo date("Y-m-d H:i:s",$v['create_time']); ?></td>
                <td><?php echo $v['big_game_name']; ?></td>
                <td>0</td>
                <td>0</td>
                <td>0/0</td>
                <td class="td-status">
                    <?php if($v['is_end'] == 1): ?>
                    <span class="label label-success radius">未结束</span>
                    <?php elseif($v['is_end'] == 2): ?>
                    <span class="label radius">已结束</span>
                    <?php endif; ?>
                </td>
                <td class="f-14 td-manage">
                    <!--onclick="edit('大赛编辑','<?php echo url('match/addMatch',['id'=>$v['id']]); ?>',1,'500','400')"-->
                    <a href="javascript:;"
                       style="color: #2a58ee;font-size: 16px"
                       onclick="Hui_admin_tab(this)"
                       data-href="<?php echo url('bigGame/bigGame',['id'=>$v['id']]); ?>"
                       data-title="修改大赛">修改</a>
                    <a href="javascript:;"
                       style="color: #2a58ee;font-size: 16px"
                       data-title="查看阶段"
                       data-href="<?php echo url('gamePhase/phaseList',['id'=>$v['id']]); ?>"
                       onclick="Hui_admin_tab(this)">查看阶段</a>
                    <a href="#" style="color: #2a58ee;font-size: 16px">单选竞猜</a>
                    <a href="#" style="color: #2a58ee;font-size: 16px">多选竞猜</a>
                    <a href="#" style="color: #2a58ee;font-size: 16px">冠军竞猜</a>
                    <a href="javascript:;" onclick="del(this,'<?php echo $v['id']; ?>')" style="color: #bd130c;font-size: 16px">删除</a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
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

    $('.table-sort').dataTable({
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "pading":false,
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
        ]
    });


    /*资讯-添加*/
    function article_add(title,url,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*编辑*/
    function edit(title,url,id,w,h)
    {
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*查看阶段*/
    // function gamePhase(url,id,w,h)
    // {
    //     var index = layer.open({
    //         type: 2,
    //         content: url
    //     });
    //     layer.full(index);
    // }


    /*删除*/
    function del(obj,id)
    {
        layer.confirm('确认要删除吗？',function(index)
        {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('match/del'); ?>",
                dataType: 'json',
                data:{'id':id},
                success: function(result)
                {
                    if(result.status == 1)
                    {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:2000});
                    }else{
                        layer.msg(result.msg,{icon:5,time:2000});
                    }
                },
                error:function(result)
                {
                    console.log(result.msg);
                },
            });
        });
    }

    /*资讯-审核*/
    function article_shenhe(obj,id){
        layer.confirm('审核文章？', {
                btn: ['通过','不通过','取消'],
                shade: false,
                closeBtn: 0
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                $(obj).remove();
                layer.msg('已发布', {icon:6,time:1000});
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                $(obj).remove();
                layer.msg('未通过', {icon:5,time:1000});
            });
    }
    /*资讯-下架*/
    function article_stop(obj,id){
        layer.confirm('确认要下架吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            layer.msg('已下架!',{icon: 5,time:1000});
        });
    }

    /*资讯-发布*/
    function article_start(obj,id){
        layer.confirm('确认要发布吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布!',{icon: 6,time:1000});
        });
    }
    /*资讯-申请上线*/
    function article_shenqing(obj,id){
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
    }

</script>
</body>
</html>